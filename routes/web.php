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

Route::get('/','ProjectController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home','ProjectController@index');




Route::get('/ajax',function() {
    return view('message');
 });
Route::get('/getmsg','AjaxController@index');

Route::get('/project/index1',function () {
    return view('project.index');
});

Route::get('/project/index', 'ProjectController@index');
Route::get('/entry/index', 'EntryController@index');

Route::get('usertype/user',['as'=>'usertype.user','uses'=>'UserTypeController@user']);
Route::get('usertype/ttadmin',['as'=>'usertype.ttadmin','uses'=>'UserTypeController@ttadmin']);
Route::get('usertype.clientmanager',['as'=>'usertype.clientmanager','uses'=>'UserTypeController@clientmanager']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/project/index2', 'ProjectController@index2');
Route::post('/project/searchproject', 'ProjectController@searchproject');
