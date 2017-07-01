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
	//Broker
	Route::get('broker', 'BrokerController@index');
	Route::get('broker/{id}/update', 'BrokerController@getUpdateBroker');
	Route::post('broker/update', 'BrokerController@postUpdateBroker');
	Route::get('broker/{id}/delete', 'BrokerController@getSoftDelete');

	//Logistics
	Route::get('logistics', 'LogisticsController@index');
	Route::get('logistics/{id}/delete', 'LogisticsController@getSoftDelete');
	//Procurement
	Route::get('procurement', 'ProcurementController@index');
	Route::get('procurement/{id}/delete', 'ProcurementController@getSoftDelete');
	//Farmer
	Route::get('farmer', 'FarmerController@index');
	Route::get('farmer/{id}/delete', 'FarmerController@getSoftDelete');
	
	/*
	* Routes for manage masters
	*/
	//Commodity Master
	//Route::get('commodity', 'CommodityController@index');
	Route::resource('commodity','CommodityController');
	Route::get('commodity/{id}/{status}/updateStatus', 'CommodityController@updateStatus');
	Route::get('commodity/{id}/updateDelete', 'CommodityController@deleteCommodity');
	//Route::get('commodity/{id}/updateCommodity', 'CommodityController@updateCommodity');
	//Route::post('commodity/{id}/updateCommodity', 'CommodityController@updateCommodity');
	//Route::post('commodity/store', 'CommodityController@store');
	Route::post('commodity_add', 'CommodityController@store');
	Route::post('commodity_edit', 'CommodityController@updateCommodity');
	
	//Role Master
	Route::get('roles', 'RoleController@index');
	Route::get('roles/{id}/{status}/updateStatus', 'RoleController@updateStatus');
	Route::post('role_add', 'RoleController@postAddRole');
	Route::get('roles/{id}/delete', 'RoleController@getDelete');
	Route::get('roles/{id}/edit', 'RoleController@getEdit');
	Route::post('role_edit', 'RoleController@postEdit');
	
	//Unit Master
	Route::get('units', 'UnitController@index');
	Route::get('units/{id}/{status}/updateStatus', 'UnitController@updateStatus');
	Route::post('unit_add', 'UnitController@postAddUnit');
	Route::get('units/{id}/delete', 'UnitController@getDelete');
	Route::get('units/{id}/edit', 'UnitController@getEdit');
	Route::post('unit_edit', 'UnitController@postEdit');

	//Plan Master
	Route::get('plans', 'PlansController@index');
	Route::get('plans/{id}/{status}/updateStatus', 'PlansController@updateStatus');
	Route::post('plan_add', 'PlansController@postAddPlan');
	Route::get('plans/{id}/delete', 'PlansController@getDelete');
	Route::get('plans/{id}/edit', 'PlansController@getEdit');
	Route::post('plan_edit', 'PlansController@postEdit');
	
	//Advertisement
	Route::get('advertisements', 'AdvertisementController@index');
	Route::post('advertisement_add', 'AdvertisementController@postAddAdvertisement');
	Route::get('advertisements/{id}/view', 'AdvertisementController@getViewAdvertisement');
	Route::get('advertisements/{id}/edit', 'AdvertisementController@getEditAdvertisement');
	Route::post('advertisement_edit', 'AdvertisementController@postEditAdvertisement');
	Route::get('advertisements/{id}/delete', 'AdvertisementController@getSoftDelete');
	Route::get('advertisements/{id}/delete_img', 'AdvertisementController@getSoftDeleteImg');
	//Markets
	Route::get('markets', 'MarketMasterController@index');
	Route::post('markets_add', 'MarketMasterController@postAddMarket');
	Route::get('markets/{id}/view', 'MarketMasterController@getViewMarket');
	Route::get('markets/{id}/edit', 'MarketMasterController@getEditMarketMaster');
	Route::post('markets_edit', 'MarketMasterController@postEditMarkets');
	Route::get('markets/{id}/delete', 'MarketMasterController@getDelete');
	Route::get('markets/{id}/delete_market_pricedate', 'MarketMasterController@getSoftDelete_market_pricedate');
	//News
	Route::get('news', 'NewsController@index');
	Route::post('news_add', 'NewsController@postAddNews');
	Route::get('news/{id}/edit', 'NewsController@getEditNews');
	Route::post('news_edit', 'NewsController@postEditNews');
	Route::get('news/{id}/delete', 'NewsController@getSoftDelete');
});




