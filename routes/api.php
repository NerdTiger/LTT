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
Route::get('/index_de','AdminController@index_de');
Route::get('/index_pr','AdminController@index_pr');
Route::get('/index_us','AdminController@index_us');
Route::get('/index_re','AdminController@index_re');
Route::get('/configuration','AdminController@configuration');
Route::get('/index','AdminController@index');
Route::get('/projects','AdminController@projects');
Route::get('/tasks','AdminController@tasks');
Route::get('/projectadd','AdminController@projectadd');
Route::get('/taskadd','AdminController@taskadd');
Route::get('/saveproject','AdminController@saveproject');
Route::get('/projectedit','AdminController@projectedit');
Route::get('/searbypcodecode','AdminController@searbypcodecode');
Route::get('/taskedit','AdminController@taskedit');
Route::get('/','AdminController@savetask');
Route::get('/searchtaskbycode','AdminController@searchtaskbycode');
Route::get('/groups','AdminController@groups');
Route::get('/groupadd','AdminController@groupadd');
Route::get('/gcodeedit','AdminController@gcodeedit');
Route::get('/savegcode','AdminController@savegcode');
Route::get('/searchgcodebycode','AdminController@searchgcodebycode');
Route::get('/savedepartment','AdminController@savedepartment');
Route::get('/savepracticearea','AdminController@savepracticearea');
Route::get('/getuseraccesses','AdminController@getuseraccesses');
Route::get('/saveusertypes','AdminController@saveusertypes');
Route::get('/getusertypes','AdminController@getusertypes');
Route::get('/savepayee','AdminController@savepayee');
Route::get('/savecompany','AdminController@savecompany');
Route::get('/index_py','AdminController@index_py');
Route::get('/index_cp','AdminController@index_cp');
Route::get('/load_user','AdminController@load_user');
Route::get('/list_user','AdminController@list_user');
Route::get('/search_user','AdminController@search_user');
Route::get('/save_user','AdminController@save_user');
Route::get('/load_all_user','AdminController@load_all_user');
Route::get('/new_user','AdminController@new_user');
// user

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
