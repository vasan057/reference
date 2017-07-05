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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

    Route::get('Introscreen','Api\Introscreen@index');
	Route::any('storeCustomer','Api\Customerapi@store');
	Route::any('customerlogin','Api\Customerapi@customerLogin');
    Route::get('apiCustomer','Api\Customerapi@index');
    Route::get('Menucategorie','Api\Menucategorie@index');
    Route::get('Restaurants','Api\Restaurants@index');
    Route::get('restaurantshome','Api\Restaurants@restaurant_home');
    Route::any('browserestaurants','Api\Restaurants@doSearchRestaurant');
    Route::any('viewmenuitems','Api\Restaurants@doViewMenuitemId');
    Route::any('viewAboutRestaurant','Api\Restaurants@doViewAboutRestaurant');
	Route::get('restaurantsmenu','Api\Restaurantsmenu@index');
    Route::any('CategoriesMenuItems','Api\Restaurants@getCategoriesMenuItems');
    Route::any('AddCartItems','Api\Cartdetails@getAddCartItems');
    Route::any('getCartItemsdetails','Api\Cartdetails@getCartItemsDetails');
    Route::any('doremoveCart','Api\Cartdetails@doRemoveCartItems');
    Route::any('doupdateCart','Api\Cartdetails@getUpdateCartItems');
    Route::any('doaddorderitems','Api\Orders@doAddNewOrder');
    Route::any('orderItemsHistory','Api\Orders@getOrderItemsHistory');
    Route::any('doGetpresentorders','Api\Orders@getPresentOrderItems');
    Route::any('orderItemsdetails','Api\Orders@getOrderItemsDetails');
    Route::any('getcustomeraddress','Api\Customeraddress@getCustomerAddress');
    Route::any('setpickupaddress','Api\Customeraddress@doSetPickupAddress');
    Route::any('checkoutaddress','Api\Customeraddress@getCustomerCheckoutAddress');
    Route::any('customeraddaddress','Api\Customeraddress@store');
    Route::any('customerupdateaddress','Api\Customeraddress@UpdateCustomerAddress');
    Route::any('removeaddress','Api\Customeraddress@doRemoveAddress');
    Route::get('getcountry','Api\Master@getCountry');
    Route::any('getcity','Api\Master@getcity');
    Route::get('getstate','Api\Master@getState');
    Route::any('doViewprofile','Api\Profile@index');
    Route::any('doChangePassword','Api\Profile@doChangePassword');
    Route::any('doupdateprofile','Api\Profile@store');
    Route::any('doApiforgetpassword','Api\Profile@doForgetpassword');
    Route::any('doupdateprofileimage','Api\Profile@doChangeProfileimage');
    //Route::any('doChangeforgetPassword/{id}','Api\Profile@doChangeforgetPassword');
    //Route::match(['get', 'post']
    
    //Route::any('doChangeforgetnewPassword','Api\Profile@doChangenewforgetPassword');
    Route::any('doFavouritehistory','Api\Menufavourite@index');
    Route::any('doAddRemovefavourite','Api\Menufavourite@store');
    Route::any('doFilteritems','Api\Filters@getFilterItems');
    Route::any('doFiltercategoryitems','Api\Filters@getFilterCategoryItems');
    Route::any('doAddTableBooking','Api\Tablebooking@store');
    Route::any('doDeliveryboyLogin','Api\Deliveryboy@DeliveryboyLogin');
    Route::any('doDeliveryboyViewProfile','Api\Deliveryboy@DeliveryboyProfile');
    Route::any('doDeliveryboyChangestatus','Api\Deliveryboy@DeliveryboyChangestatus');
    Route::any('doGetDeliveryboyOrders','Api\Deliveryboy@DeliveryboyOrders');
    Route::any('doGetDeliveryboyOrderitems','Api\Deliveryboy@DeliveryboyOrdersitems');
    Route::any('doDeliveryboyUpdatelocation','Api\Deliveryboy@DeliveryboyUpdatelocation');
    Route::any('doDeliveryboyDeliveredstatus','Api\Deliveryboy@DeliveryboyDeliveredstatus');
    Route::any('send_notification','Api\Deliveryboy@send_notification');
    Route::any('doCustomertracksapi','Api\Customertracksdeliveryboy@Customertracksapi');
    
