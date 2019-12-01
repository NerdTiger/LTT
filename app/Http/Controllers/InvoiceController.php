<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use Config;

class InvoiceController extends Controller
{
	private $invoice_date;	
	private $invoice_period;
	private $mail_instance;
	private $check_mail_address='0';

	private $showonpage='1';
	private $it_test='0';
	private $test_accounting_mail_address;
	private $test_enduser_mail_address;
	public function __construct(){
		ini_set("xdebug.var_display_max_children", -1);
		ini_set("xdebug.var_display_max_data", -1);
		ini_set("xdebug.var_display_max_depth", -1);
		$this->middleware('auth');
		$this->setup_MailServer();
		$test_mail_config=Config::get("app.test_mail");		

		$this->test_accounting_mail_address=$test_mail_config['accounting'];
		$this->test_enduser_mail_address=$test_mail_config['enduser'];
		
	}
	private function setup_MailServer(){

    	try{			
			$mail=new PHPMailer(true);
    		$mail->isSMTP();
    		$mail->CharSet = 'utf-8';
    		$mail->SMTPAuth =true;
			$mail->SMTPSecure = env('MAIL_ENCRYPTION');
    		$mail->Host = env('MAIL_HOST'); //gmail has host > smtp.gmail.com
    		$mail->Port = env('MAIL_PORT'); //gmail has port > 587 . without double quotes
    		$mail->Username = env('MAIL_USERNAME'); //your username. actually your email
			$mail->Password = env('MAIL_PASSWORD'); // your password. your mail password
			$this->mail_instance=$mail;
			
    	}catch(phpmailerException $e){
    		dd($e);
    	}catch(Exception $e){
    		dd($e);
    	}

	}
	public function test_mail(Request $request){
		$test_mail_address=$request->input('test_mail_address');
		$test_mail_username=$request->input('test_mail_username');
		if(empty($test_mail_address))return;
		$to=[
			"test_mail_address"=>$test_mail_address,
			"test_mail_username"=>$test_mail_username
		];
		$from='ttinvoicing@salesbeacon.com';
		$this->test_mail_sending($from,'this is a test mail','if this mail is received, mail sending is working',$to);
	}
	public function cmd_test_mail($test_mail_address,$test_mail_username){
		if(empty($test_mail_address))return;
		if(empty($test_mail_username))return;
		$to=[
			"test_mail_address"=>$test_mail_address,
			"test_mail_username"=>$test_mail_username
		];
		$from='ttinvoicing@salesbeacon.com';
		$this->test_mail_sending($from,'this is a test mail','if this mail is received, mail sending is working',$to);
	}

	private function test_mail_sending($from,$subject,$mail_content,$to){
	$mail=$this->mail_instance;
		$mail->SetFrom($from);
		$mail->Subject = $subject;
		$mail->MsgHTML($mail_content);
		// $mail->addAddress('kevin.it@salesbeacon.com','kevin it'); //$mail_to
		$mail->addAddress($to['test_mail_address'],$to['test_mail_username']); //$mail_to
		$mail->send();

	}
	
	private  function sendEmail($mail_content,$subject,$mail_to,$user_name){
		$from='ttinvoicing@salesbeacon.com';

        $mail = $this->mail_instance;
    	try{
			$mail->SetFrom($from);
    		$mail->Subject = $subject;
    		$mail->MsgHTML($mail_content);
		    $mail->addAddress($mail_to,$user_name); 
    		$mail->send();
    	}catch(phpmailerException $e){
    		dd($e);
    	}catch(Exception $e){
    		dd($e);
    	}
    	if($mail){
			
			error_log("mail to $mail_to success");
			$mail->ClearAllRecipients();
    	}else{
    		error_log("mail to $mail_to failed");
    	}

	}
	private  function sendEmail_ex($mail_content,$subject,$recipients){
		$from='ttinvoicing@salesbeacon.com';

        $mail = $this->mail_instance;
    	try{
			$mail->SetFrom($from);
    		$mail->Subject = $subject;
    		$mail->MsgHTML($mail_content);
    		foreach($recipients as $recipient){
    		    $mail->addAddress($recipient['mail_address'],$recipient['mail_username']); 
    		}
    		
    		$mail->send();
    	}catch(phpmailerException $e){
    		dd($e);
    	}catch(Exception $e){
    		dd($e);
    	}
    	if($mail){
			
			error_log("mail to  success");
			$mail->ClearAllRecipients();
    	}else{
    		error_log("mail to failed");
    	}

	}
	
	public function index(Request $request)
    {
		$user_id=$request->input('user_id');
		$invoice_month=$request->input('invoice_month');
		$invoice_year=$request->input('invoice_year');
		$mail_content= $this->build_invoice_for_contractor_monthly($invoice_year,$invoice_month);
		//echo $mail_content;
		$this->sendEmail($mail_content);
	}	
	private function send_invoice_mail($invoice_content){
		echo $invoice_content;
	}
	
	private function get_date_range_fromyearmonth($invoice_year,$invoice_month){
		
		$start_date=date_create($invoice_year.'-'.$invoice_month.'-01');
		$end_date=date_sub(date_create($invoice_year.'-'.($invoice_month+1).'-01'),date_interval_create_from_date_string("1 day"));

		$this->invoice_date=$end_date->format('Y-m-d');
		$this->invoice_period=$invoice_year."-".sprintf("%02d", $invoice_month);
		return [
		"start_date"=>$start_date->format('Y-m-d'),
		"end_date"=>$end_date->format('Y-m-d'),
		];
	}
	public function cmd_biweekly_invoice($invoice_date='',$check_mail_address='0',$showonpage='0',$it_test='0'){
		//called from cronjob
		if($invoice_date==='')return;
		$this->check_mail_address=empty($check_mail_address)?'0':$check_mail_address;
		$this->showonpage=empty($showonpage)?'0':$showonpage;
		$this->it_test=empty($it_test)?'0':$it_test;
		$this->generate_biweeklyreport_for_employees($invoice_date);
	}
	public function cmd_monthly_invoice($invoice_year='',$invoice_month='',$check_mail_address='0',$showonpage='0',$it_test='0'){
		//called from cronjob
		if($invoice_month==='')return;
		if($invoice_year==='')return;
		$this->check_mail_address=empty($check_mail_address)?'0':$check_mail_address;
		$this->showonpage=empty($showonpage)?'0':$showonpage;
		$this->it_test=empty($it_test)?'0':$it_test;
		$this->generate_invoice_for_contractor_monthly($invoice_year,$invoice_month);
	}


	public function biweekly_invoice(Request $request){
	//called from browser
		$invoice_date=$request->input('invoice_date');
		$this->check_mail_address=empty($request->input('check_mail_address'))?'0':$request->input('check_mail_address');
		$this->showonpage=empty($request->input('showonpage'))?'0':$request->input('showonpage');
		$this->it_test=empty($request->input('it_test'))?'0':$request->input('it_test');
		$this->generate_biweeklyreport_for_employees($invoice_date);
	}
	public function monthly_invoice(Request $request){
	//called from browser
		$invoice_month=$request->input('invoice_month');
		$invoice_year=$request->input('invoice_year');
		$this->check_mail_address=empty($request->input('check_mail_address'))?'0':$request->input('check_mail_address');
		$this->showonpage=empty($request->input('showonpage'))?'0':$request->input('showonpage');
		$this->it_test=empty($request->input('it_test'))?'0':$request->input('it_test');
		$this->generate_invoice_for_contractor_monthly($invoice_year,$invoice_month);
	}

	//called by cron job
	public function generate_invoice_for_contractors($invoice_year,$invoice_month){
		$date_range=$this->get_date_range_fromyearmonth($invoice_year,$invoice_month);
		$start_date=$date_range['start_date'];
		$end_date=$date_range['end_date'];
	}
	
	public function index_monthly(){
		$user_rows=null;
		$months=$this->getMonths();
		$resource_types=$this->get_resource_status();	
		return view('autoinvoice_monthly',array('user_rows'=>$user_rows,'months'=>$months,'resource_types'=>$resource_types));	

	}
	public function index_rangedate(){
		$user_rows=null;
		$months=$this->getMonths();
		$resource_types=$this->get_resource_status();	
		return view('autoinvoice_rangedate',array('user_rows'=>$user_rows,'months'=>$months,'resource_types'=>$resource_types));	

	}
	public function index_paymentsummary(){
		$user_rows=null;
		$months=$this->getMonths();
		return view('payment_summary_generate',array('months'=>$months));	
	}

	
	public function get_users_rangedate(Request $request){
		$usertypeselect=$request->input('usertypeselect1');
		$start_date=$request->input('FromDate');
		$end_date=$request->input('ToDate');

		$user_rows=[];
		$query=DB::table('time_entry as te')
		->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
		->join('users as u','u.user_id','pr.project_resource_resource_id')
		->leftjoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
		->where('te.entry_deleted','0')
		->whereIn('res.resource_status',$usertypeselect)		
		->whereBetween('te.entry_date', [$start_date, $end_date])
		->selectRaw('distinct u.user_id,u.user_email,u.user_name,u.user_lastname,res.resource_status,u.user_billing_name')
		->orderBy('res.resource_status')->orderBy('u.user_email')->orderBy('u.user_lastname');
		//$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
		//dd($sql);
	
		$user_rows = $query->get();
	
		$months=$this->getMonths();
		$resource_types=$this->get_resource_status();	
		return view('autoinvoice_rangedate',array('user_rows'=>$user_rows,'months'=>$months,'resource_types'=>$resource_types,
		'usertypeselect1'=>null,
		'start_date'=>$start_date,
		'end_date'=>$end_date,
	));	
	}
	
	public function get_users_monthly(Request $request){
		$usertypeselect1=$request->input('usertypeselect1');
		$usertypeselect=$request->input('multi_usertypes');
		$date_selection=$request->input('date_selection');
		// $date_from =$request->input('FromDate');
		// $date_to=$request->input('ToDate');


		$usertypes = $usertypeselect1;
		$dates = explode('-', $date_selection);
		$user_rows=[];

		$a=['consultant','contractor'];
		$b=array($usertypes);
		if(isset($dates)&& count($dates)>1){		
			$invoice_year=$dates[0];
			$invoice_month=$dates[1];
			$date_range=$this->get_date_range_fromyearmonth($invoice_year,$invoice_month);
			$start_date=$date_range['start_date'];
			$end_date=$date_range['end_date'];
	
			// $start_date,$end_date,$invoice_period
			$query=DB::table('time_entry as te')
			->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
			->join('users as u','u.user_id','pr.project_resource_resource_id')
			->leftjoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
			->where('te.entry_deleted','0')
			->whereIn('res.resource_status',$usertypes)
			//->whereIn('res.resource_status',['consultant','contractor'])
			->whereBetween('te.entry_date', [$start_date, $end_date])
			->selectRaw('distinct u.user_id,u.user_email,u.user_name,u.user_lastname,res.resource_status,u.user_billing_name')
			->orderBy('res.resource_status')->orderBy('u.user_email')->orderBy('u.user_lastname');
			//$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
			//dd($sql);

			$user_rows = $query->get();
		}
		
		$months=$this->getMonths();
		$resource_types=$this->get_resource_status();	
		return view('autoinvoice_monthly',array('user_rows'=>$user_rows,'months'=>$months,'resource_types'=>$resource_types,'usertypeselect1'=>$usertypeselect,'date_selection'=>$date_selection));	


	}
	private function get_resource_status(){

		$query=DB::table('resource_employment_status as u')
		->orderBy('resource_status')
		->selectRaw('distinct resource_status');
		$resource_statuses=$query->get();
		return $resource_statuses;
	}
	private function getMonths() #gives a date - an incremental month number
	{
		
		$month_counter;
		$pres_date = date('Y-m');
		$newdate = explode("-",$pres_date); #yyyy-mm-dd
		$year = $newdate[0];
		$month = $newdate[1];
		$months=[];
		#now adjust month for incrementer
		$selectmonth = $month; #set to equal current month to start
		$selectyear=0;
		for($incrementer = 0;$incrementer<=8;$incrementer++){
			if ($month <=$incrementer)
			{
				$selectmonth = sprintf("%02d", ($month+12 - $incrementer));
				$selectyear = $year--;
			}
			else
			{
				$selectmonth = sprintf("%02d", ($month - $incrementer));
				$selectyear = $year;
			}
			$day = "01";
			$month_counter = "$year" . "-" . "$selectmonth" . "-" . "$day";
			//return $month_counter;
		array_push($months,$month_counter);	
		}
		return $months;

	}
	public function generate_invoices_rangedate(Request $request){
 		//called from UI
		 $test_mail_config=Config::get("app.test_mail");		
		 $this->check_mail_address=empty($test_mail_config['check_mail_address'])?'0':$test_mail_config['check_mail_address'];
		 $this->showonpage=empty($test_mail_config['showonpage'])?'0':$test_mail_config['showonpage'];
		 $this->it_test=empty($test_mail_config['it_test'])?'0':$test_mail_config['it_test'];
 
		$invoice_content='';
		$user_rows = $request->input('check_list','selected');
		$usertypeselect1=$request->input('usertypeselect1');
		$start_date=$request->input('FromDate');
		$end_date=$request->input('ToDate');


		$summary_report = $request->input('summary_report');
		$user_ids=[];
		foreach($user_rows as $user_row){
			$user_info=explode('$',$user_row);
			$user_id=$user_info[0];
			$user_email=$user_info[3];
			$user_name=$user_info[1].' ' . $user_info[2];

			array_push($user_ids,$user_id);
		}

		$invoice_content='';
		$invoice_html='';
		$summary_report_html='';
		$CAD_users=[];
		$USD_users=[];
		$total_info_CADUsers=[];
		$total_info_USDUsers=[];



		foreach($user_rows as $user_row){
				$user_info=explode('$',$user_row);
				$user_id=$user_info[0];
				$mail_option=$request->input('mail_option_'.$user_id);
				$user_email=$user_info[3];
				$user_name=$user_info[1].' ' . $user_info[2];
				$this->invoice_date=$end_date;
				$this->invoice_period=date_format(date_create($start_date),'Y/m/d').'-'.date_format(date_create($end_date),'Y/m/d');
				$invoice_number=$user_id . "-" . $this->invoice_period;
				$invoice_number='Not Invoice';
				$subject = "Biweekly Payment Report $this->invoice_period for $user_name";	
				$invoice_data=$this->generate_invoice(0,$user_id,$start_date,$end_date,$invoice_number,$this->invoice_period);
				if($this->check_mail_address==='0'){
					$invoice_html=view('paymentreport_generate',array('invoice_data'=>$invoice_data));	
					if($this->showonpage==='1'){
						echo $invoice_html;	
					}
					else{
						
						if($this->it_test==='1')
						{
							if($mail_option==='Resource Only'){
								$this->sendEmail($invoice_html,$subject,$this->test_enduser_mail_address['mail_address'],$this->test_enduser_mail_address['mail_username']);
							}
							elseif($mail_option==='Both'){
								$recipients=[
								[
								"mail_address"=>$this->test_accounting_mail_address['mail_address'],
								"mail_username"=>$this->test_accounting_mail_address['mail_username'],
								],
								[
								"mail_address"=>$this->test_enduser_mail_address['mail_address'],
								"mail_username"=>$this->test_enduser_mail_address['mail_username'],
								]
							    ];
								$this->sendEmail_ex($invoice_html,$subject,$recipients);
							}
							elseif($mail_option==='Sales Beacon Only'){
								$this->sendEmail($invoice_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
							}
						}
						else {				
							if($mail_option==='Resource Only'){
								$this->sendEmail($mail_content,$subject,$user_email,$user_name);
							}
							elseif($mail_option==='Both'){
								$this->sendEmail($mail_content,$subject,$user_email,$user_name);
								$this->sendEmail($invoice_html,$subject,$this->test_enduser_mail_address['mail_address'],$this->test_enduser_mail_address['mail_username']);
								$recipients=[
								[
								"mail_address"=>$this->test_accounting_mail_address['mail_address'],
								"mail_username"=>$this->test_accounting_mail_address['mail_username'],
								],
								[
								"mail_address"=>$user_email,
								"mail_username"=>$user_name,
								]
							    ];
								$this->sendEmail_ex($invoice_html,$subject,$recipients);
								
							}
							elseif($mail_option==='Sales Beacon Only'){
								$this->sendEmail($mail_content,$subject,$user_email,$user_name);
							}
						}
					}
				}
				else{
					$invoice_html=$user_email.'<br/>';	
					echo $invoice_html;
				}
		}

		if($summary_report === 'on'){
			$this->invoice_period='';
			$query=DB::table('time_entry as te')
			->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
			->join('users as u','u.user_id','pr.project_resource_resource_id')
			->where([['te.entry_deleted','0'],['u.user_currency','CAD']])
			->whereBetween('te.entry_date', [$start_date, $end_date])
			->whereIn('u.user_id', $user_ids)
			->groupBy('u.user_id')
			->selectRaw('u.user_id,concat(user_name," ",user_lastname)username,SUM(te.entry_hours) * pr.project_resource_sales_beacon_rate billedwork,u.user_currency,u.user_tax,user_health_plan_deduction,user_rrsp_deduction,user_billing_name')
			;


			$user_rows = $query->get();


			if(isset($user_rows)&& count($user_rows)>0){
				$group_currency='';
				$total_billedwork_CADUsers=0.00;
				$total_GST_CADUsers=0.00;
				$total_subtotal_CADUsers=0.00;
				$total_meddeduction_CADUsers=0.00;
				$total_rrspdeduction_CADUsers=0.00;
				$total_CADUsers=0.00;
				$total_billedwork_USDUsers=0.00;
				$total_GST_USDUsers=0.00;
				$total_subtotal_USDUsers=0.00;
				$total_meddeduction_USDUsers=0.00;
				$total_rrspdeduction_USDUsers=0.00;
				$total_USDUsers=0.00;

				$subtotal_employees;

			foreach($user_rows as $user_row){
				$billedwork=$user_row->billedwork;
				$user_currency=$user_row->user_currency;
				$user_billing_name=$user_row->user_billing_name;
				$user_name=$user_row->username;
				$user_tax=$user_row->user_tax;
				$gst=$billedwork*$user_tax;
				$subtotal=$billedwork+$gst;
				$user_health_plan_deduction=$user_row->user_health_plan_deduction;
				$user_rrsp_deduction=$user_row->user_rrsp_deduction;
				$user_total=$subtotal-$user_health_plan_deduction-$user_rrsp_deduction;

				$user_info=[
					"billedwork"=>$billedwork,
					"user_tax"=>$gst,
					"subtotal"=>$subtotal,
					"user_health_plan_deduction"=>$user_health_plan_deduction,
					"user_rrsp_deduction"=>$user_rrsp_deduction,
					"user_currency"=>$user_currency,
					"user_billing_name"=>$user_billing_name,
					"user_name"=>$user_name,
					"user_total"=>$user_total
				];

				if($group_currency==='' || $user_currency==$group_currency){
					if($user_currency==='CAD'){
						$total_billedwork_CADUsers+=$billedwork;
						$total_GST_CADUsers+=$gst;
						$total_subtotal_CADUsers+=$subtotal;
						$total_meddeduction_CADUsers+=$user_health_plan_deduction;
						$total_rrspdeduction_CADUsers+=$user_rrsp_deduction;
						$total_CADUsers+=$user_total;

						array_push($CAD_users,$user_info);
					}
					else{
						$group_currency=$user_currency;
						$total_billedwork_USDUserss+=$billedwork;
						$total_GST_USDUserss+=$gst;
						$total_subtotal_USDUserss+=$subtotal;
						$total_meddeduction_USDUserss+=$user_health_plan_deduction;
						$total_rrspdeduction_USDUserss+=$user_rrsp_deduction;
						$total_USDUsers+=$user_total;
						array_push($USD_users,$user_info);
					}
				}	
			}
				$total_info_CADUsers=[
					"total_billedwork_CADUsers"=>$total_billedwork_CADUsers,
					"total_GST_CADUsers"=>$total_GST_CADUsers,
					"total_subtotal_CADUsers"=>$total_subtotal_CADUsers,
					"total_meddeduction_CADUsers"=>$total_meddeduction_CADUsers,
					"total_rrspdeduction_CADUsers"=>$total_rrspdeduction_CADUsers,
					"total_CADUsers"=>$total_CADUsers,
					"currency"=>'CAD'
				];
				$total_info_USDUsers=[
					"total_billedwork_USDUsers"=>$total_billedwork_USDUsers,
					"total_GST_USDUsers"=>$total_GST_USDUsers,
					"total_subtotal_USDUsers"=>$total_subtotal_USDUsers,
					"total_meddeduction_USDUsers"=>$total_meddeduction_USDUsers,
					"user_rrsp_deduction"=>$user_rrsp_deduction,
					"total_rrspdeduction_USDUsers"=>$total_rrspdeduction_USDUsers,
					"total_USDUsers"=>$total_USDUsers,
					"currency"=>'USD'
				];
				$report_date=date('Y-m-d');

				
				$summary_report_html=view('payment_summary_generate',
				array("report_date"=>$report_date,
					"invoice_date"=>$this->invoice_date,
					"invoice_period"=>$this->invoice_period,
					'CAD_users'=>$CAD_users,
					'USD_users'=>$USD_users,
					'total_info_CADUsers'=>$total_info_CADUsers,
					'total_info_USDUsers'=>$total_info_USDUsers
					));	
				if($this->check_mail_address==='0'){
					if($this->showonpage==='1'){
						echo $summary_report_html;
					}
					else{
						$subject = "Summary Report $this->invoice_period";	
						if($this->it_test==='1'){
							$this->sendEmail($summary_report_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
							
						}
						else{
							$this->sendEmail($summary_report_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
						}
					}
				}
				else{
					$invoice_html=$this->test_accounting_mail_address['mail_address'].'<br/>';	
					echo $invoice_html;

				}	
				}
			else{
				//show page with messahe "no valid payment summary report"
	
			}	
		}
		//echo $invoice_content.$summary_report_html;

	}
	
	public function generate_payment_summary(Request $request){

		$date_selection=$request->input('date_selection');
		$dates = explode('-', $date_selection);
		$user_rows=[];
		if(isset($dates)&& count($dates)>1){		
			$invoice_year=$dates[0];
			$invoice_month=$dates[1];
			$date_range=$this->get_date_range_fromyearmonth($invoice_year,$invoice_month);
			$start_date=$date_range['start_date'];
			$end_date=$date_range['end_date'];
	
			$query=DB::table('time_entry as te')
			->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
			->join('users as u','u.user_id','pr.project_resource_resource_id')
			->where([['te.entry_deleted','0'],['u.user_currency','CAD']])
			->whereBetween('te.entry_date', [$start_date, $end_date])
			->groupBy('u.user_id')
			->selectRaw('u.user_id,SUM(te.entry_hours) * pr.project_resource_sales_beacon_rate billedwork,u.user_currency,u.')
			;
	

			$user_rows = $query->get();
			//rows of contractors
			//subtotal of contractors
			//rows of employees
			//subtotal of employees


			if(isset($user_rows)&& count($user_rows)>0){

				//$this->generate_payment_summary_report($user_rows,$start_date, $end_date);
			}
			else{
				//show page with messahe "no valid payment summary report"
	
			}
			}


	}
	//called by UI
	
	public function generate_invoices_monthly(Request $request){
		//called from UI
		$test_mail_config=Config::get("app.test_mail");		
		$this->check_mail_address=empty($test_mail_config['check_mail_address'])?'0':$test_mail_config['check_mail_address'];
		$this->showonpage=empty($test_mail_config['showonpage'])?'0':$test_mail_config['showonpage'];
		$this->it_test=empty($test_mail_config['it_test'])?'0':$test_mail_config['it_test'];


		$invoice_content='';
		$user_rows = $request->input('check_list','selected');
		

		$usertypeselect1=$request->input('usertypeselect1');
		$date_selection=$request->input('date_selection');
		$summary_report = $request->input('summary_report');
		$user_ids=[];
		foreach($user_rows as $user_row){
			$user_info=explode('$',$user_row);
			$user_id=$user_info[0];
			$user_email=$user_info[3];
			$user_name=$user_info[1].' ' . $user_info[2];
			

			array_push($user_ids,$user_id);
		}


		$dates = explode('-', $date_selection);
		$invoice_content='';
		$invoice_html='';
		$summary_report_html='';
		$CAD_users=[];
		$USD_users=[];
		$total_info_CADUsers=[];
		$total_info_USDUsers=[];

		if(isset($dates)&& count($dates)>1){		
			$invoice_year=$dates[0];
			$invoice_month=$dates[1];
			$date_range=$this->get_date_range_fromyearmonth($invoice_year,$invoice_month);
			$start_date=$date_range['start_date'];
			$end_date=$date_range['end_date'];

			$this->invoice_period=$invoice_year."-".sprintf("%02d", $invoice_month);			

			foreach($user_rows as $user_row){
				$user_info=explode('$',$user_row);
				$user_id=$user_info[0];
				$mail_option=$request->input('mail_option_'.$user_id);
				$user_email=$user_info[3];
				$user_name=$user_info[1].' ' . $user_info[2];
				$this->invoice_period=$invoice_year."-".sprintf("%02d", $invoice_month);
				$invoice_number=$user_id . "-" . $this->invoice_period;
				$subject = "Monthly Invoice $this->invoice_period for $user_name";	
				$invoice_data=$this->generate_invoice(1,$user_id,$start_date,$end_date,$invoice_number,$this->invoice_period);
				
				if($this->check_mail_address==='0'){
					$invoice_html=view('invoice_generate',array('invoice_data'=>$invoice_data));	
					if($this->showonpage==='1'){
						echo $invoice_html;
	
					}
					else{
						$subject = "Monthly Invoice $this->invoice_period for $user_name";	
						if($this->it_test==='1')
						{
							if($mail_option==='Resource Only'){
								$this->sendEmail($invoice_html,$subject,$this->test_enduser_mail_address['mail_address'],$this->test_enduser_mail_address['mail_username']);
								//$this->sendEmail('Resource Only',$subject,$this->test_enduser_mail_address['mail_address'],$this->test_enduser_mail_address['mail_username']);
								
							}
							elseif($mail_option==='Both'){
								$recipients=[
								[
								"mail_address"=>$this->test_accounting_mail_address['mail_address'],
								"mail_username"=>$this->test_accounting_mail_address['mail_username'],
								],
								[
								"mail_address"=>$this->test_enduser_mail_address['mail_address'],
								"mail_username"=>$this->test_enduser_mail_address['mail_username'],
								]
							    ];
								$this->sendEmail_ex($invoice_html,$subject,$recipients);
							}
							elseif($mail_option==='Sales Beacon Only'){
								$this->sendEmail($invoice_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
							}
						}
						else {				
							if($mail_option==='Resource Only'){
								$this->sendEmail($mail_content,$subject,$user_email,$user_name);
							}
							elseif($mail_option==='Both'){
								$recipients=[
								[
								"mail_address"=>$this->test_accounting_mail_address['mail_address'],
								"mail_username"=>$this->test_accounting_mail_address['mail_username'],
								],
								[
								"mail_address"=>$user_email,
								"mail_username"=>$user_name,
								]
							    ];
								$this->sendEmail_ex($invoice_html,$subject,$recipients);
							}
							elseif($mail_option==='Sales Beacon Only'){
								$this->sendEmail($mail_content,$subject,$user_email,$user_name);
							}
						}
					}
				}
				else{
					$invoice_html=$user_email.'<br/>';	
					echo $invoice_html;
				}
			}


			if($summary_report === 'on'){
				$query=DB::table('time_entry as te')
				->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
				->join('users as u','u.user_id','pr.project_resource_resource_id')
				->where([['te.entry_deleted','0'],['u.user_currency','CAD']])
				->whereBetween('te.entry_date', [$start_date, $end_date])
				->whereIn('u.user_id', $user_ids)
				->groupBy('u.user_id')
				->selectRaw('u.user_id,concat(user_name," ",user_lastname)username,SUM(te.entry_hours) * pr.project_resource_sales_beacon_rate billedwork,u.user_currency,u.user_tax,user_health_plan_deduction,user_rrsp_deduction,user_billing_name')
				;
	
	
				$user_rows = $query->get();
	
	
				if(isset($user_rows)&& count($user_rows)>0){
					$group_currency='';
					$total_billedwork_CADUsers=0.00;
					$total_GST_CADUsers=0.00;
					$total_subtotal_CADUsers=0.00;
					$total_meddeduction_CADUsers=0.00;
					$total_rrspdeduction_CADUsers=0.00;
					$total_CADUsers=0.00;
					$total_billedwork_USDUsers=0.00;
					$total_GST_USDUsers=0.00;
					$total_subtotal_USDUsers=0.00;
					$total_meddeduction_USDUsers=0.00;
					$total_rrspdeduction_USDUsers=0.00;
					$total_USDUsers=0.00;
	
					$subtotal_employees;
	
				foreach($user_rows as $user_row){
	
						$billedwork=$user_row->billedwork;
						$user_currency=$user_row->user_currency;
						$user_billing_name=$user_row->user_billing_name;
						$user_name=$user_row->username;
						$username=$user_row->username;
						$user_tax=$user_row->user_tax;
						$gst=$billedwork*$user_tax;
						$subtotal=$billedwork+$gst;
						$user_health_plan_deduction=$user_row->user_health_plan_deduction;
						$user_rrsp_deduction=$user_row->user_rrsp_deduction;
						$user_total=$subtotal-$user_health_plan_deduction-$user_rrsp_deduction;
	
	
						$user_info=[
							"billedwork"=>$billedwork,
							"user_tax"=>$gst,
							"subtotal"=>$subtotal,
							"user_health_plan_deduction"=>$user_health_plan_deduction,
							"user_rrsp_deduction"=>$user_rrsp_deduction,
							"user_currency"=>$user_currency,
							"user_billing_name"=>$user_billing_name,
							"user_name"=>$user_name,
							"user_total"=>$user_total
						];
	
						if($group_currency==='' || $user_currency==$group_currency){
							if($user_currency==='CAD'){
								$total_billedwork_CADUsers+=$billedwork;
								$total_GST_CADUsers+=$gst;
								$total_subtotal_CADUsers+=$subtotal;
								$total_meddeduction_CADUsers+=$user_health_plan_deduction;
								$total_rrspdeduction_CADUsers+=$user_rrsp_deduction;
								$total_CADUsers+=$user_total;
	
								array_push($CAD_users,$user_info);
						}else{
							$group_currency=$user_currency;
							$total_billedwork_USDUserss+=$billedwork;
							$total_GST_USDUserss+=$gst;
							$total_subtotal_USDUserss+=$subtotal;
							$total_meddeduction_USDUserss+=$user_health_plan_deduction;
							$total_rrspdeduction_USDUserss+=$user_rrsp_deduction;
							$total_USDUsers+=$user_total;
							array_push($USD_users,$user_info);
							}
	
						}	
	
					}
					$total_info_CADUsers=[
						"total_billedwork_CADUsers"=>$total_billedwork_CADUsers,
						"total_GST_CADUsers"=>$total_GST_CADUsers,
						"total_subtotal_CADUsers"=>$total_subtotal_CADUsers,
						"total_meddeduction_CADUsers"=>$total_meddeduction_CADUsers,
						"total_rrspdeduction_CADUsers"=>$total_rrspdeduction_CADUsers,
						"total_CADUsers"=>$total_CADUsers,
						"currency"=>'CAD'
					];
					$total_info_USDUsers=[
						"total_billedwork_USDUsers"=>$total_billedwork_USDUsers,
						"total_GST_USDUsers"=>$total_GST_USDUsers,
						"total_subtotal_USDUsers"=>$total_subtotal_USDUsers,
						"total_meddeduction_USDUsers"=>$total_meddeduction_USDUsers,
						"user_rrsp_deduction"=>$user_rrsp_deduction,
						"total_rrspdeduction_USDUsers"=>$total_rrspdeduction_USDUsers,
						"total_USDUsers"=>$total_USDUsers,
						"currency"=>'USD'
					];
					$report_date=date('Y-m-d');
					
					$summary_report_html=view('payment_summary_generate',
					array("report_date"=>$report_date,
						'invoice_date'=>$this->invoice_date,
						'invoice_period'=>$this->invoice_period,
						'CAD_users'=>$CAD_users,
						'USD_users'=>$USD_users,
						'total_info_CADUsers'=>$total_info_CADUsers,
						'total_info_USDUsers'=>$total_info_USDUsers
						));	
				}
				else{
					//show page with messahe "no valid payment summary report"
		
				}	
				if($this->check_mail_address==='0'){
					if($this->showonpage==='1'){
						echo $summary_report_html;
					}
					else{
						$subject = "Summary Report $this->invoice_period";	
						if($this->it_test==='1'){
							$this->sendEmail($summary_report_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
						}
						else{
							$this->sendEmail($summary_report_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
							
						}
					}
				}
				else{
					$invoice_html=$this->test_accounting_mail_address['mail_address'].'<br/>';	
					echo $invoice_html;

				}
			}
		}
	}
	private function build_invoice_for_contractor_monthly($start_date,$end_date,$invoice_period){
		$invoice_html='';
		$query=DB::table('time_entry as te')
        ->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
		->join('users as u','u.user_id','pr.project_resource_resource_id')
		->leftjoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
		->where('te.entry_deleted','0')
		->whereIn('res.resource_status',['Consultant', 'Contractor', 'Corp to Corp', 'Freelance', 'US Consultant', 'US Contractor', 'US Corp to Corp', 'US Freelance'])
		->whereBetween('te.entry_date', [$start_date, $end_date])
		->selectRaw('distinct u.user_id,u.user_email,u.user_name,u.user_lastname')
		->orderBy('u.user_email')->orderBy('u.user_lastname')
		;
		
		$user_rows = $query->get();		
		foreach($user_rows as $user_row){
			$user_id=$user_row->user_id;
			$user_email=$user_row->user_email;
			$user_name=$user_row->user_name.' ' . $user_row->user_lastname;
			$invoice_number=$user_id . "-" . $invoice_period;
			$subject = "Monthly Invoice $invoice_period for $user_name";	
			$invoice_data=$this->generate_invoice(1,$user_id,$start_date,$end_date,$invoice_number,$invoice_period);
			
			if($this->check_mail_address==='0'){
				$invoice_html=view('invoice_generate',array('invoice_data'=>$invoice_data));	
				if($this->showonpage==='1'){
					echo $invoice_html;

				}
				else{
					$subject = "Monthly Invoice $invoice_period for $user_name";	
					if($this->it_test==='1')
					{
						$this->sendEmail($invoice_html,$subject,$this->test_enduser_mail_address['mail_address'],$this->test_enduser_mail_address['mail_username']);
						$this->sendEmail($invoice_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
					}
					else {				
						$this->sendEmail($invoice_html,$subject,$user_email,$user_name);
						$this->sendEmail($invoice_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
					}
				}
			}
			else{
				$invoice_html=$user_email.'<br/>';	
				echo $invoice_html;
			}
			
		}
	}
	private function build_biweeklyreport_content($start_date,$end_date,$invoice_number,$invoice_period){

		$query=DB::table('time_entry as te')
        ->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
		->join('users as u','u.user_id','pr.project_resource_resource_id')
		->leftjoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
		->where([
			['te.entry_deleted','0']
        ])
		 ->whereBetween('te.entry_date', [$start_date->format('Y-m-d'), $end_date->format('Y-m-d')])
		 ->whereIn('res.resource_status', ["F/T Hourly Employee", "P/T Hourly Employee", "Salary + Employee", "Salary Employee", "Temp Hourly Employee","US F/T Hourly Employee",  "US P/T Hourly Employee", "US Salary + Employee", "US Salary Employee"])
		->selectRaw('distinct u.user_id,u.user_email,u.user_name,u.user_lastname,res.resource_status')
		 ->orderBy('res.resource_status')->orderBy('u.user_email')->orderBy('u.user_lastname')
		;
		//$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
		//dd($sql);

		$user_rows = $query->get();		
		foreach($user_rows as $user_row){
			$user_id=$user_row->user_id;
			$user_email=$user_row->user_email;
			$user_name=$user_row->user_name.' ' . $user_row->user_lastname;
			$invoice_number=$invoice_number;
			$subject = "Biweekly Payment Report $invoice_period for $user_name";	
			$invoice_data=$this->generate_invoice(0,$user_id,$start_date,$end_date,$invoice_number,$invoice_period);
			if($this->check_mail_address==='0'){
				//$invoice_html=view('invoice_generate',array('invoice_data'=>$invoice_data));	
				$invoice_html=view('paymentreport_generate',array('invoice_data'=>$invoice_data));	
				if($this->showonpage==='1'){
					echo $invoice_html;
	
				}else{
					if($this->it_test==='1')
					{
						$this->sendEmail($invoice_html,$subject,$this->test_enduser_mail_address['mail_address'],$this->test_enduser_mail_address['mail_username']);
						$this->sendEmail($invoice_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
					}
					else {				
						$this->sendEmail($invoice_html,$subject,$user_email,$user_name);
						$this->sendEmail($invoice_html,$subject,$this->test_accounting_mail_address['mail_address'],$this->test_accounting_mail_address['mail_username']);
					}
					}
				
				
				}
				else{
					$invoice_html=$user_email.'<br/>';	
					echo $invoice_html;
				}
		}
	}
	//called by cmd and 
	private function generate_invoice_for_contractor_monthly($invoice_year,$invoice_month){

		$this->invoice_period=$invoice_year."-".sprintf("%02d", $invoice_month);
		$date_range=$this->get_date_range_fromyearmonth($invoice_year,$invoice_month);
		$start_date=$date_range['start_date'];
		$end_date=$date_range['end_date'];
		$this->build_invoice_for_contractor_monthly($start_date,$end_date,$this->invoice_period);
	}
	private function generate_biweeklyreport_for_employees($invoice_date){
		$end_date=date_sub(date_create($invoice_date),date_interval_create_from_date_string("1 day"));
		$start_date=date_sub(date_create($invoice_date),date_interval_create_from_date_string("14 days"));
		$this->invoice_date=date_format(date_create($invoice_date),'Y-m-d');
		$this->invoice_period=date_format($start_date,'Y/m/d')." to ".date_format($end_date,'Y/m/d');
		$invoice_number='Not an Invoice';
		$this->build_biweeklyreport_content($start_date,$end_date,$invoice_number,$this->invoice_period);
	}

	private function generate_invoice($isInvoice,$user_id,$start_date,$end_date,$invoice_number,$invoice_period){
		$query=DB::table('users as u')
		->leftjoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
		->where([
			['u.user_id',$user_id],
        ])
		->selectRaw('user_id,user_name, user_lastname, user_street, user_city, user_prov, user_zip, user_tax, user_tax_number, 
		user_tax_other, user_tax_other_number, user_country, user_billing_name, user_email, user_health_plan_opt_in, user_health_plan_deduction, 
		user_rrsp_opt_in, user_rrsp_deduction, user_currency, user_typeofperson,res.bill_address');
		$user_info=$query->first();
		
		$user_info->user_id=isset($user_info->user_id)?$user_info->user_id:0;
		$user_info->user_tax=isset($user_info->user_tax)?$user_info->user_tax:0;
		$user_info->user_tax_other=isset($user_info->user_tax_other)?$user_info->user_tax_other:0;
		$user_info->user_health_plan_deduction=isset($user_info->user_health_plan_deduction)?$user_info->user_health_plan_deduction:0;
		$user_info->user_rrsp_deduction=isset($user_info->user_rrsp_deduction)?$user_info->user_rrsp_deduction:0;

		$query=DB::table('time_entry as te')
        ->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
		->join('project as p','p.project_id','pr.project_resource_project_id')
		->join('users as u','u.user_id','pr.project_resource_resource_id')
		->leftjoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
		->leftjoin('practice_area as pp','pp.practice_area_id','p.project_practice_area_id')
		->where([
			['u.user_id',$user_id],
			['te.entry_deleted','0'],
        ])
		->whereBetween('te.entry_date', [$start_date, $end_date])
		->groupBy('u.user_id','p.project_number', 'p.project_renewal','te.entry_project_resource_id')
		->selectRaw('SUM(te.entry_hours)projecthours, p.project_title , p.project_number,p.project_renewal,pr.project_resource_sales_beacon_rate cost,ifnull(pp.practice_area_name," ") practice_area_name,p.project_renewal,p.project_type')
		;

		$project_rows = $query->get();

		$ttlhrs = 0;
		$totaltemp=0;
		foreach($project_rows as $row){
			$row->projecthours=isset($row->projecthours)?$row->projecthours:0;
			$row->cost=isset($row->cost)?$row->cost:0.00;
			$hourstemp = $row->projecthours;
			$ratetemp= $row->cost;
			$ttlhrs+=$row->projecthours;

			#print cost per line item
			$totalcost = $hourstemp*$ratetemp;
			$totaltemp = $totaltemp + $totalcost ;#increment overall totals counter
		}

		$project_MED=[];
		$project_RRSP=[];
		if ($user_info->user_health_plan_opt_in == 1 && $isInvoice===1) 
		{
			$project_MED=['project_number'=>'MED','project_title'=>'Sales Beacon Contractor Health Plan Deduction','project_cost'=>$user_info->user_health_plan_deduction];
		}
			
		
		if ($user_info->user_rrsp_opt_in == 1) 
		{
			$project_RRSP=['project_number'=>'RRSP','project_title'=>'Sales Beacon Contractor RRSP Plan Deduction','project_cost'=>$user_info->user_rrsp_deduction];
		}

		$totaltemp_formatted = $totaltemp;
		$pattern = '/(^[-+]?\d+?(?=(?>(?:\d{3})+)(?!\d))|\G\d{3}(?=\d))/';
		$replacement = '$1';
		$totaltemp_formatted=preg_replace($pattern, $replacement, $totaltemp_formatted);
		$taxes1 = $user_info->user_tax * $totaltemp;
		
		#TAX OF TAX is the way that tax 2 works
		$taxes2 =  $user_info->user_tax_other * ($totaltemp + $taxes1);
		$taxes = $taxes1 + $taxes2;
		$taxes=sprintf("%.2f", $taxes);
		$healthdeductions = $user_info->user_health_plan_deduction;
		$rrspdeductions = $user_info->user_rrsp_deduction;
		$grandtotal = $taxes + $totaltemp - $healthdeductions - $rrspdeductions;
		

		$pattern = '/(^[-+]?\d+?(?=(?>(?:\d{3})+)(?!\d))|\G\d{3}(?=\d))/';
		$replacement = '$1';
		$taxes=preg_replace($pattern, $replacement, $taxes);
		
		
		$pattern = '/(^[-+]?\d+?(?=(?>(?:\d{3})+)(?!\d))|\G\d{3}(?=\d))/';
		$replacement = '$1';
		$grandtotal=preg_replace($pattern, $replacement, $grandtotal);

		$total_data=['taxes'=>$taxes,
		'healthdeductions'=>$healthdeductions,
		'rrspdeductions'=>$rrspdeductions,
		'totaltemp_formatted'=>$totaltemp_formatted,
		'grandtotal'=>$grandtotal,
		'ttlhrs'=>$ttlhrs,
		];

		if($isInvoice===1)		
		$invoice_info=['invoice_number'=>$invoice_number,'invoice_date'=>$this->invoice_date,'invoice_period'=>$this->invoice_period];
		else 
		$invoice_info=['invoice_number'=>$invoice_number,'invoice_date'=>date('Y-m-d'),'invoice_period'=>$this->invoice_period];

		return [
			'invoice_info'=>$invoice_info,
			'user_info'=>$user_info,
			'project_rows'=>$project_rows,
			'med_rrsp'=>['project_MED'=>$project_MED,'project_RRSP'=>$project_RRSP],
			'total_data'=>$total_data
		];
	}

}
	