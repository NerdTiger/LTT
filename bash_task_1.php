<?php
use App\Http\Controllers;

require_once('index.php');
$invoice_ins=new App\Http\Controllers\InvoiceController();

$invoice_ins->generate_invoice_for_contractors(2019,8);
