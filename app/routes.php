<?php



/*

|--------------------------------------------------------------------------

| Application Routes

|--------------------------------------------------------------------------

|

| Here is where you can register all of the routes for an application.

| It's a breeze. Simply tell Laravel the URIs it should respond to

| and give it the Closure to execute when that URI is requested.

|

*/
Route::get('registration/mail', array('as' => 'registration.mail', 'uses' => 'RegistrationController@sendMail'));

/* INDEX ROUTES */
Route::get('/', array('as' => 'home', 'uses'=>'IndexController@dark'));

Route::get('about-us', array('as' => 'about', 'uses' => 'IndexController@aboutUs'));
Route::get('activity-schedule', array('as' => 'activity', 'uses' => 'IndexController@activitySchedule'));
Route::get('facility', array('as' => 'facility', 'uses' => 'IndexController@ourFacility'));
Route::get('menu', array('as' => 'menu', 'uses' => 'IndexController@menu'));

Route::get('hash/{password}', array('as' =>'hash', 'uses'=>'UserController@makeHash'));

Route::get('logout', array('as' =>'logout', 'uses'=>'UserController@logout'));
Route::get('login', array('as' =>'login.form', 'uses'=>'UserController@getLogin'));
Route::post('login', array('as' =>'login.process', 'uses'=>'UserController@processLogin'));


Route::get('inquiry', array('as' => 'inquiry.list', 'uses'=>'InquiryController@getList'));
Route::get('inquiry/{inquiry_id}', array('as' =>'inquiry.details', 'uses'=>'InquiryController@getDetails'));
Route::get('contact-us', array('as' => 'inquiry.form', 'uses' => 'InquiryController@getForm'));
Route::post('inquiry-save', array('as' => 'inquiry.process', 'uses' => 'InquiryController@postSave'));
Route::post('inquiry/update-status', array('as' => 'inquiry.update.status', 'uses' => 'InquiryController@postUpdateStatus'));
Route::post('inquiry/delete', array('as' => 'inquiry.delete', 'uses' => 'InquiryController@postDelete'));

Route::get('registration', array('as' => 'registration.list', 'uses' => 'RegistrationController@getList'));
Route::get('registration/{registration_id}', array('as' => 'registration.details', 'uses' => 'RegistrationController@getDetails'));
Route::get('pre-register', array('as' => 'registration.form', 'uses' => 'RegistrationController@getForm'));
Route::post('registration-confirmed', array('as' => 'registration.process', 'uses' => 'RegistrationController@postSave'));
Route::post('registration/update-status', array('as' => 'registration.update.status', 'uses' => 'RegistrationController@postUpdateStatus'));
Route::post('registration/delete', array('as' => 'registration.delete', 'uses' => 'RegistrationController@postDelete'));


