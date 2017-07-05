<?php

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index');
	Route::any('/dashboard','HomeController@dashboard');

	//--------------------Admin Controller--------------
	Route::any('/manageRestaurents/{status?}/{restaurantId?}','adminController@manageRestaurents');
	Route::any('/addNewRestaurant','adminController@addNewRestaurant');
	Route::any('/managePositions/{status?}/{positionId?}','adminController@managePositions');
	Route::any('/manageEmployees/{status?}/{employeeId?}','adminController@manageEmployees');
	Route::any('/changePassword','adminController@changePassword');

	//--------------------Order Controller------------
	Route::any('/manageMenu/{status?}/{menuId?}','OrderController@manageMenu');
	Route::any('/managerestaurantMenus/{status?}{menuItemId?}','OrderController@managerestaurantMenus');
	Route::any('/manageCategories/{status?}/{categoryId?}','OrderController@manageCategories');
	Route::any('/manageMenuItems/{status?}/{menuId?}','OrderController@manageMenuItems');
	Route::any('/manageOrders/{status?}/{orderId?}/{customerId?}','OrderController@manageOrders');
	Route::get('/getCustomerAddress','OrderController@getCustomerAddress');
	Route::any('getMenuItemPrice','OrderController@getMenuItemPrice');
	Route::post('/getOrderStatus','OrderController@getOrderStatus');
	Route::any('/manageOrderTypes/{status?}/{orderTypeId?}','OrderController@manageOrderTypes');
	Route::any('/manageMapView','OrderController@manageMapView');
	Route::any('/manageOrderStatus/{status?}/{orderStatusId?}','OrderController@manageOrderStatus');
	Route::any('/manageOrdersdetails/{status?}/{orderId?}','OrderController@manageOrdersDetails');

	//---------------------Master Controller-------------------
	Route::any('/manageAddressTypes/{status?}/{addressId?}','MasterController@manageAddressTypes');
	Route::any('/manageMasterCity/{status?}/{cityId?}','MasterController@manageMasterCity');
	Route::any('/manageMasterState/{status?}/{stateId?}','MasterController@manageMasterState');
	Route::get('/getState','MasterController@getState');
	Route::any('/manageMasterCountry/{status?}/{countryId?}','MasterController@manageMasterCountry');

	//---------------------Coupon Controller-------------------
	Route::any('/manageCoupon/{status?}/{couponId?}','CouponController@manageCoupon');

	//---------------------Banner Controller-------------------
	Route::any('/manageBanner/{status?}/{bannerId?}','BannerController@manageBanner');

	//---------------------Carts Controller-------------------
	Route::any('/manageCarts/{status?}/{cartId?}','CartsController@manageCarts');
	Route::any('/manageCartsdetails/{status?}/{cartDetsId?}','CartsController@manageCartsdetails');
	Route::get('/getItemsAjax','CartsController@getItemsAjax');

	//---------------------Customers Controller-------------------
	Route::any('/manageCustomers/{status?}/{customerId?}','CustomersController@manageCustomers');
	Route::any('/customeraddress/{status?}/{addressId?}','CustomersController@managecustomeraddress');
	Route::any('/manageCartItems/{status?}/{cartItemId?}','CustomersController@manageCartItems');

	//---------------------Delivery Tracks Controller-------------------
	Route::any('/deliveryTracks/{status?}/{deliveryId?}','DeliverytracksController@manageDelivery');
	Route::get('/getCustomerBillAjax','DeliverytracksController@getCustomerBillAjax');

	//---------------------Dinning Table Controller-------------------
	Route::any('/manageDiningtable/{status?}/{tableId?}','DiningtableController@manageDiningTable');
	Route::any('/manageDinningTableStatus/{status?}/{tableStatusId?}','DiningtableController@manageDinningTableStatus');
	Route::any('/manageDiningtabletracks/{status?}/{dinningTableTrackId?}','DiningtableController@manageDiningTableTracks');

	//---------------------Section Controller-------------------
	Route::any('/manageSection/{status?}/{sectionId?}','SectionController@manageSection');
	Route::any('/manageSectiontypes/{status?}/{sectionId?}','SectionController@manageSectiontypes');
	Route::any('/manageSectionProperties/{status?}/{sectionprptyId?}','SectionController@manageSectionProperties');

	//---------------------Image Reference Controller-------------------
	Route::any('/manageImagereference/{status?}/{menuId?}','ImagereferenceController@manageImagereference');
	Route::any('/manageImagerefernce/{status?}/{menuId?}','ImagereferenceController@doManageImage');

	//---------------------Reservation Controller-------------------
	Route::any('/manageReservation/{status?}/{reservationId?}','ReservationController@manageReservation');

	//---------------------Billing Controller-------------------
	Route::any('/manageBilling/{status?}/{billId?}','BillingController@manageBilling');
	Route::get('/getOrderDetsAjax','BillingController@getOrderDetsAjax');

	//---------------------Users Controller-------------------
	Route::any('/manageUser/{status?}/{userid?}','UsersController@manageUser');
	Route::any('/userChangePassword/{status?}/{userid?}','UsersController@userChangePassword');

	//---------------------Floor View Controller-------------------
	Route::any('/manageFloorView/{status?}','FloorViewController@manageFloorView');
});
Route::get('doChangeforgetPassword/{id}','Profile@doChangeforgetPassword');
Route::any('doChangeforgetnewPassword','Profile@doChangenewforgetPassword');