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

// 29100921 1515 comemnt for login page back
Route::get('/{any}', function () {
    return view('post');
  })->where('any', '.*');



// Route::get('/selectdemo', function () {
//     return view('SelectDemo');
// })->name('SelectDemo');

Auth::routes(['register' => false]);
Auth::routes();



// Route::get('/', function () {
//     return view('welcome');
//   });


/*

*/