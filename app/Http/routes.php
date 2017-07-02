<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::get('/', 'HomeController@getUserLogin');
Route::get('/login', 'HomeController@getUserLogin');
Route::post('/user_post_login', 'HomeController@UserPostLogin');
Route::post('/logout', 'HomeController@logout');
Route::get('forgot_password', 'HomeController@getForgotPassword');
Route::post('forgotpassword', 'HomeController@postForgotPassword');
Route::get('register_franchisee', 'HomeController@registerFranchisee');
Route::post('add_franchisee', 'HomeController@registerFranchiseeSave');


Route::group(['middleware' => ['auth', 'validateBackHistory']], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::post('reset_password', 'HomeController@postResetPassword');
	#ADMIN
	
	Route::get('franchisee', 'FranchiseeController@index');
	Route::get('customer', 'CustomerController@index');
	
	
	//Common user code
	Route::get('user/{id}/view', 'CommonController@view');
	Route::get('user/{id}/{status}/{durl}/updateStatus', 'CommonController@updateStatusUser');
	Route::get('user/{id}/delete', 'CommonController@getSoftDelete');
	Route::post('update_profile', 'CommonController@updateUserProfile');
	Route::post('update_bankDetails', 'CommonController@updateUserBankDetails');
	Route::get('user/{id}/updateCredits', 'CommonController@updateCredits');
	Route::post('credits_add', 'CommonController@doUpdateCredits');
	Route::get('transactions', 'CommonController@transactions');
	Route::post('credits_request', 'FranchiseeController@requestCredits');
	Route::get('franchiseeCreditRequests', 'FranchiseeController@listRequests');
	Route::get('rejectCreditsRequest/{id}', 'FranchiseeController@rejectCreditsRequest');
	Route::get('approveCreditsRequest/{id}', 'FranchiseeController@approveCreditsRequest');
	Route::get('franchiseeCreditRequestsToAdmin', 'FranchiseeController@listRequestsToAdmin');
	
	
});