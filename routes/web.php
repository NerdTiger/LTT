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
Route::get('/autoinvoice/index', 'InvoiceController@index2');

Route::get('/biweekly_invoice', 'InvoiceController@biweekly_invoice');
Route::get('/monthly_invoice', 'InvoiceController@monthly_invoice');
Route::get('/testlogic', 'InvoiceController@testlogic');
Route::get('/project/index', 'ProjectController@index');
Route::get('/mailable',function(){
return new App\Mail\AutoInvoice3();
});
