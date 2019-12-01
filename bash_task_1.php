<?php

use App\Http\Controllers;


require_once('index.php');
use Illuminate\Support\Facades\Log;

Log::error('batch is executed at'.date('Y-m-d H:i:s'));

//use Illuminate\Support\Facades\Log;
//Log::error('Something is really going wrong.');


$execute_year = date('Y');
$execute_month=date('m');
$execute_day=date('d');
$today=date('Y-m-d');




$biweekly_payment_day=array(
    '2019-11-11','2019-11-25','2019-12-09','2019-12-23','2020-01-06',
    '2020-01-20','2020-02-03','2020-02-17','2020-03-02','2020-03-16',
    '2020-03-30','2020-04-13','2020-04-27','2020-05-11','2020-05-25',
    '2020-06-08','2020-06-22','2020-07-06','2020-07-20','2020-08-03'

    );
    

if($execute_day==='01'){
    $invoice_ins=new App\Http\Controllers\InvoiceController();
    $invoice_ins->cmd_monthly_invoice($execute_year,$execute_month,'0','0','0');
}
else{ 
    Log::error( "today is not 1st for invoicing");
    
}
if(in_array($today,$biweekly_payment_day)){


$invoice_ins=new App\Http\Controllers\InvoiceController();
$invoice_ins->cmd_biweekly_invoice($today,'0','0','0');

}else{ Log::error( "today is not pay day");}


