<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;


class InvoiceController extends Controller
{
	private $invoice_date;	
	public function __construct(){
		ini_set("xdebug.var_display_max_children", -1);
		ini_set("xdebug.var_display_max_data", -1);
		ini_set("xdebug.var_display_max_depth", -1);
	}	
	private  function sendEmail($mail_content,$subject,$mail_to,$user_name){
		$from='ttinvoicing@salesbeacon.com';

        $mail = new PHPMailer(true);
    	try{
    		$mail->isSMTP();
    		$mail->CharSet = 'utf-8';
    		$mail->SMTPAuth =true;
			$mail->SMTPSecure = env('MAIL_ENCRYPTION');
    		$mail->Host = env('MAIL_HOST'); //gmail has host > smtp.gmail.com
    		$mail->Port = env('MAIL_PORT'); //gmail has port > 587 . without double quotes
    		$mail->Username = env('MAIL_USERNAME'); //your username. actually your email
    		$mail->Password = env('MAIL_PASSWORD'); // your password. your mail password
			$mail->SetFrom($from);
    		$mail->Subject = $subject;
    		$mail->MsgHTML($mail_content);
    		$mail->addAddress('kevin.it@salesbeacon.com','kevin it'); //$mail_to
    		$mail->send();
    	}catch(phpmailerException $e){
    		dd($e);
    	}catch(Exception $e){
    		dd($e);
    	}
    	if($mail){
			
			error_log("mail to $mail_to success");
    	}else{
    		error_log("mail to $mail_to failed");
    	}

}

public function index6(Request $request){
	// $user_id=$request->input('user_id');
	// $invoice_month=$request->input('invoice_month');
	// $invoice_year=$request->input('invoice_year');
	// $mail_content= $this->build_invoice_content($invoice_year,$invoice_month);
	return view('autoinvoice');


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
	
	private function get_date_range($invoice_year,$invoice_month){
		
		$start_date=date_create($invoice_year.'-'.$invoice_month.'-01');
		$end_date=date_sub(date_create($invoice_year.'-'.($invoice_month+1).'-01'),date_interval_create_from_date_string("1 day"));

		$today=date_create(date('Y/m/d H:i:s'));
		$this->invoice_date=$today->format('Y-m-d');
		return [
		"start_date"=>$start_date->format('Y-m-d'),
		"end_date"=>$end_date->format('Y-m-d'),
		];
	}
	public function biweekly_invoice(Request $request){

		$invoice_date=$request->input('invoice_date');
		$this->generate_biweeklyreport_for_employees($invoice_date);
	}
	public function monthly_invoice(Request $request){

		$invoice_month=$request->input('invoice_month');
		$invoice_year=$request->input('invoice_year');
		$this->generate_invoice_for_contractor_monthly($invoice_year,$invoice_month);
	}

	public function generate_invoice_for_contractors($invoice_year,$invoice_month){
		$date_range=$this->get_date_range($invoice_year,$invoice_month);
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
	public function get_users_rangedate(Request $request){
		$usertypeselect1=$request->input('usertypeselect1');
		$start_date=$request->input('FromDate');
		$end_date=$request->input('ToDate');

		$user_rows=[];
		$query=DB::table('time_entry as te')
		->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
		->join('users as u','u.user_id','pr.project_resource_resource_id')
		->leftjoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
		->where([
			['te.entry_deleted','0'],
			['res.resource_status',$usertypeselect1],
		])
		->whereBetween('te.entry_date', [$start_date, $end_date])
		->selectRaw('distinct u.user_id,u.user_email,u.user_name,u.user_lastname,res.resource_status')
		->orderBy('res.resource_status')->orderBy('u.user_email')->orderBy('u.user_lastname');
		
		$user_rows = $query->get();
	
		$months=$this->getMonths();
		$resource_types=$this->get_resource_status();	
		return view('autoinvoice_rangedate',array('user_rows'=>$user_rows,'months'=>$months,'resource_types'=>$resource_types,
		'usertypeselect1'=>$usertypeselect1,
		'start_date'=>$start_date,
		'end_date'=>$end_date,
	));	
	}
	public function get_users_monthly(Request $request){
		$usertypeselect1=$request->input('usertypeselect1');
		$date_selection=$request->input('date_selection');
		// $date_from =$request->input('FromDate');
		// $date_to=$request->input('ToDate');


		$dates = explode('-', $date_selection);
		$user_rows=[];
		if(isset($dates)&& count($dates)>1){		
			$invoice_year=$dates[0];
			$invoice_month=$dates[1];
			$date_range=$this->get_date_range($invoice_year,$invoice_month);
			$start_date=$date_range['start_date'];
			$end_date=$date_range['end_date'];
	
			// $start_date,$end_date,$invoice_period
			$query=DB::table('time_entry as te')
			->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
			->join('users as u','u.user_id','pr.project_resource_resource_id')
			->leftjoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
			->where([
				['te.entry_deleted','0'],
				['res.resource_status',$usertypeselect1],
			])
			->whereBetween('te.entry_date', [$start_date, $end_date])
			->selectRaw('distinct u.user_id,u.user_email,u.user_name,u.user_lastname,res.resource_status')
			->orderBy('res.resource_status')->orderBy('u.user_email')->orderBy('u.user_lastname');
			
			$user_rows = $query->get();
		}
		
		$months=$this->getMonths();
		$resource_types=$this->get_resource_status();	
		return view('autoinvoice_monthly',array('user_rows'=>$user_rows,'months'=>$months,'resource_types'=>$resource_types,'usertypeselect1'=>$usertypeselect1,'date_selection'=>$date_selection));	


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
		$invoice_content='';
		$user_rows = $request->input('check_list','selected');
		

		$usertypeselect1=$request->input('usertypeselect1');
		$start_date=$request->input('FromDate');
		$end_date=$request->input('ToDate');
	foreach($user_rows as $user_row){
				$user_info=explode('-',$user_row);
				$user_id=$user_info[0];
				$user_email=$user_info[3];
				$user_name=$user_info[1].' ' . $user_info[2];
				$invoice_period=$start_date."-".$end_date;
				$invoice_number=$user_id . "-" . $invoice_period;
				$subject = "Monthly Automated Invoice $invoice_period for $user_name";	
				$invoice_data=$this->generate_invoice(0,$user_id,$start_date,$end_date,$invoice_number,$invoice_period);
				
				$invoice_html=view('invoice_generate',array('invoice_data'=>$invoice_data));	
	
				$subject = "Monthly Automated Invoice $invoice_period for $user_name";	
				$invoice_content.=$invoice_html;
				
				//$this->sendEmail($invoice_html,$subject,$user_email,$user_name);
			
			echo $invoice_content;
			
		
		}
	}
public function generate_invoices_monthly(Request $request){
		$invoice_content='';
		$user_rows = $request->input('check_list','selected');
		

		$usertypeselect1=$request->input('usertypeselect1');
		$date_selection=$request->input('date_selection');
		



		$dates = explode('-', $date_selection);
		
		if(isset($dates)&& count($dates)>1){		
			$invoice_year=$dates[0];
			$invoice_month=$dates[1];
			$date_range=$this->get_date_range($invoice_year,$invoice_month);
			$start_date=$date_range['start_date'];
			$end_date=$date_range['end_date'];
			foreach($user_rows as $user_row){
				$user_info=explode('-',$user_row);
				$user_id=$user_info[0];
				$mail_option=$request->input('mail_option_'.$user_id);
				$user_email=$user_info[3];
				$user_name=$user_info[1].' ' . $user_info[2];
				$invoice_period=$invoice_year."-".sprintf("%02d", $invoice_month);
				$invoice_number=$user_id . "-" . $invoice_period;
				$subject = "Monthly Automated Invoice $invoice_period for $user_name";	
				$invoice_data=$this->generate_invoice(1,$user_id,$start_date,$end_date,$invoice_number,$invoice_period);
				
				$invoice_html=view('invoice_generate',array('invoice_data'=>$invoice_data));	
	
				$subject = "Monthly Automated Invoice $invoice_period for $user_name";	
				$invoice_content.=$invoice_html;
				
				//$this->sendEmail($invoice_html,$subject,$user_email,$user_name);
			}
			echo $invoice_content;
			
		
		}
	}
	private function build_invoice_for_contractor_monthly($start_date,$end_date,$invoice_period){

		$query=DB::table('time_entry as te')
        ->join('project_resource as pr','te.entry_project_resource_id','pr.project_resource_id')
		->join('users as u','u.user_id','pr.project_resource_resource_id')
		->leftjoin('resource_employment_status as res','res.resource_employment_status_id','u.user_resource_status_id')
		->where([
			['te.entry_deleted','0'],
			['res.resource_status','contractor'],
        ])
		->whereBetween('te.entry_date', [$start_date, $end_date])
		->selectRaw('distinct u.user_id,u.user_email,u.user_name,u.user_lastname')
		->orderBy('res.resource_status')->orderBy('u.user_email')->orderBy('u.user_lastname')
		;
		//$sql = str_replace_array('?', $query->getBindings(), $query->toSql()); 
		//dd($sql);

		
		$user_rows = $query->get();		
		foreach($user_rows as $user_row){
			$user_id=$user_row->user_id;
			$user_email=$user_row->user_email;
			$user_name=$user_row->user_name.' ' . $user_row->user_lastname;
			$invoice_number=$user_id . "-" . $invoice_period;
			$subject = "Monthly Automated Invoice $invoice_period for $user_name";	
			$invoice_data=$this->generate_invoice(1,$user_id,$start_date,$end_date,$invoice_number,$invoice_period);
			
			$invoice_html=view('invoice_generate',array('invoice_data'=>$invoice_data));	

			$subject = "Monthly Automated Invoice $invoice_period for $user_name";	
			echo $invoice_html;
			//$this->sendEmail($invoice_html,$subject,$user_email,$user_name);
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
			$subject = "Monthly Automated Invoice $invoice_period for $user_name";	
			$invoice_data=$this->generate_invoice(0,$user_id,$start_date,$end_date,$invoice_number,$invoice_period);
			
			$invoice_html=view('paymentreport_generate',array('invoice_data'=>$invoice_data));	

			$subject = "Monthly Automated Invoice $invoice_period for $user_name";	
			echo $invoice_html;
			//$this->sendEmail($invoice_html,$subject,$user_email,$user_name);
		}
	}
	private function generate_invoice_for_contractor_monthly($invoice_year,$invoice_month){

		$invoice_period=$invoice_year."-".sprintf("%02d", $invoice_month);
		$date_range=$this->get_date_range($invoice_year,$invoice_month);
		$start_date=$date_range['start_date'];
		$end_date=$date_range['end_date'];
		$this->build_invoice_for_contractor_monthly($start_date,$end_date,$invoice_period);
	}
	private function generate_biweeklyreport_for_employees($invoice_date){
		$end_date=date_sub(date_create($invoice_date),date_interval_create_from_date_string("1 day"));
		$start_date=date_sub(date_create($invoice_date),date_interval_create_from_date_string("14 days"));
		$today=date_create(date('Y/m/d H:i:s'));
		$this->invoice_date=$today->format('Y-m-d');
		$invoice_period=$start_date->format('Y-m-d')." to ".$end_date->format('Y-m-d');
		$invoice_number='Not an Invoice';
		
		$this->build_biweeklyreport_content($start_date,$end_date,$invoice_number,$invoice_period);
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


		$invoice_info=['invoice_number'=>$invoice_number,'invoice_date'=>$this->invoice_date,'invoice_period'=>$invoice_period];
		return [
			'invoice_info'=>$invoice_info,
			'user_info'=>$user_info,
			'project_rows'=>$project_rows,
			'med_rrsp'=>['project_MED'=>$project_MED,'project_RRSP'=>$project_RRSP],
			'total_data'=>$total_data
		];
	}
}
	