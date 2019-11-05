<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::post('/post/create', 'PostController@store');
Route::get('/post/edit/{id}', 'PostController@edit');
Route::post('/post/update/{id}', 'PostController@update');
Route::delete('/post/delete/{id}', 'PostController@delete');
Route::get('/posts', 'PostController@index');
*/



// project controller 
Route::get('/project/index','ProjectController@index');//working 0919 17:14 comment
Route::get('/project/listproject','ProjectController@listproject');
Route::get('/loadaddproject','ProjectController@loadaddproject');
Route::get('/savefornew','ProjectController@savefornew');
Route::get('/saveforrenew','ProjectController@saveforrenew');
Route::get('/loadprojectlist','ProjectController@loadprojectlist');
Route::get('/loadprojectlistforuser','ProjectController@loadprojectlistforuser');
Route::get('/searchproject','ProjectController@searchproject');
Route::get('/loadproject','ProjectController@loadproject');
Route::get('/assignresourceforproject','ProjectController@assignresourceforproject');
Route::get('/saveresourceassign','ProjectController@saveresourceassign');
Route::get('/saveresourceedit','ProjectController@saveresourceedit');
Route::get('/loadaddprojectByType','ProjectController@loadaddprojectByType');
Route::get('/addPOnumbersforproject','ProjectController@addPOnumbersforproject');
Route::get('/saveaddPONumber','ProjectController@saveaddPONumber');
Route::get('/addHourforProjectbyAdmin','ProjectController@addHourforProjectbyAdmin');
Route::get('/addHourforProjectbyClientManager','ProjectController@addHourforProjectbyClientManager');
Route::get('/renewProject','ProjectController@renewProject');
Route::get('/removeresourceforproject','ProjectController@removeresourceforproject');
Route::get('/removePOforproject','ProjectController@removePOforproject');
Route::get('/editresourceforproject','ProjectController@editresourceforproject');
Route::get('/saveProjectForEdit','ProjectController@saveProjectForEdit');
Route::get('/editProject','ProjectController@editProject');
Route::get('/editposforproject','ProjectController@editposforproject');

// entry controller
Route::get('/index','EntryController@index');
Route::get('/saveentryhour','EntryController@saveentryhour');
Route::get('/saveentryhour_phone','EntryController@saveentryhour_phone');
Route::get('/loadentriesforuser','EntryController@loadentriesforuser');
Route::get('/editentry','EntryController@editentry');
Route::get('/deleteentry','EntryController@deleteentry');
Route::get('/saveentryhourbyAdmin','EntryController@saveentryhourbyAdmin');
Route::get('/hoursSinceLastLockoff','EntryController@hoursSinceLastLockoff');
Route::get('/deleteEntryforAdmin','EntryController@deleteEntryforAdmin');
Route::get('/editEntryforAdmin','EntryController@editEntryforAdmin');
Route::get('/searchEntry','EntryController@searchEntry');
Route::get('/addHourforProject','EntryController@addHourforProject');
Route::get('/listHourforProjectUser','EntryController@listHourforProjectUser');
Route::get('/listHourforProject','EntryController@listHourforProject');
Route::get('/listHourforUser','EntryController@listHourforUser');
Route::get('/hoursForUserSinceLastLockoff','EntryController@hoursForUserSinceLastLockoff');
Route::get('/hoursforClientManagerSinceLastLockoffpublic','EntryController@hoursforClientManagerSinceLastLockoffpublic');
Route::get('/searchEntryForClientManager','EntryController@searchEntryForClientManager');
Route::get('/searchEntryByUser','EntryController@searchEntryByUser');
Route::get('/listHourforProjectClientManager','EntryController@listHourforProjectClientManager');

// admin controller 

Route::get('/login/getuserlogininfo','LoginController@getuserlogininfo');


Route::get('/ajax',function() {
    return view('message');
 });
Route::get('/getmsg','AjaxController@index');




Route::get('/entry/index', 'EntryController@index');

Route::get('usertype/user',['as'=>'usertype.user','uses'=>'UserTypeController@user']);
Route::get('usertype/ttadmin',['as'=>'usertype.ttadmin','uses'=>'UserTypeController@ttadmin']);
Route::get('usertype.clientmanager',['as'=>'usertype.clientmanager','uses'=>'UserTypeController@clientmanager']);
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/project/index2', 'ProjectController@index2');
Route::post('/project/searchproject', 'ProjectController@searchproject');
