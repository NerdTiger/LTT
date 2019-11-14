<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/{any}', function () {
//     return view('post');
//   })->where('any', '.*');

// Route::get('/', function () {
//   return view('project_index');
// });


// Route::get('/selectdemo', function () {
//     return view('SelectDemo');
// })->name('SelectDemo');

//Auth::routes(['register' => false]);
Auth::routes();

//Route::get('/', '/project/index');
//Route::get('/', 'ProjectController@index');
Route::get('/', function () {
    return view('welcome');

});
    
//Route::get('/autoinvoicer', 'InvoiceController@index');
Route::get('/autoinvoice/index', 'InvoiceController@index');
Route::get('/autoinvoice/index_monthly', 'InvoiceController@index_monthly')->name('index_monthly');//through schedule job
Route::get('/autoinvoice/index_rangedate', 'InvoiceController@index_rangedate')->name('index_rangedate');//through schedule job

Route::post('/listusers_monthly', 'InvoiceController@get_users_monthly')->name('listusers_monthly');//get contractor users for monthly invoice 
Route::post('/listusers_rangedate', 'InvoiceController@get_users_rangedate')->name('listusers_rangedate');//get hourly users for biweekly payment
Route::post('/generateinvoice_monthly', 'InvoiceController@generate_invoices_monthly')->name('generateinvoice_monthly');//generate invoice for users for monthly invoice 
Route::post('/generateinvoice_rangedate', 'InvoiceController@generate_invoices_rangedate')->name('generateinvoice_rangedate');//generate payment for hourly users for biweekly payment
//Route::get('/autoinvoice/getvalidusers', 'InvoiceController@get_valid_users');



Route::get('/biweekly_invoice', 'InvoiceController@biweekly_invoice');
Route::get('/monthly_invoice', 'InvoiceController@monthly_invoice');
Route::get('/testlogic', 'InvoiceController@testlogic');
Route::get('/project/index', 'ProjectController@index');
Route::get('/mailable',function(){
return new App\Mail\AutoInvoice3();
});