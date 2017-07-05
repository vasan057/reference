<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\Carts_details;
use App\Model\menu_items;
use App\Model\Order_type;
use App\Model\Order_status;
use App\Model\Order;
use App\Model\Orders_history;
use App\Model\Order_details;
use App\Model\Image_references;
use Carbon\Carbon;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Orders extends Controller
{
	//ADD CART ITEMS
	public function doAddNewOrder()
	{
		$customer_id 		=	input::get('customer_id');
		$ordertype_name 	=	input::get('ordertype_name');
		$ordertype_desc 	=	input::get('ordertype_desc');
		$order_date 		=	input::get('order_date');
		$restaurant_id 		=	input::get('restaurant_id');
		$item_id 			=	input::get('item_id');
		$item_quantity 		=	input::get('item_quantity');
		$amount 			=	input::get('amount');
		$totalamount 		=	input::get('totalamount');
		$address_type_id 	=	input::get('address_type_id');
		if($customer_id 	==	"" || $ordertype_name 	==	"" || $ordertype_desc 	==	"" || $order_date 	==	""	|| $restaurant_id 	==	"" || $item_id 	==	"" || $item_quantity == "" || $amount ==	"" || $totalamount == "" || $address_type_id == "")
		{
			return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'All Fields are required'
								]);	
		}
		//AUTHENTICATE FOR CUSTOMER
		$customerauth 		=	app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);

		if($customerauth 	==	"Success")
		{
			//SAVE ORDER TYPE 
			$Ordertypeid 			=	config::get("common.onstatus");
			$Orderstatusid 			=	config::get("common.neworder");
			if(!empty($item_id) && count($item_id) >= 1)
			{
				$insertorders 	=	array('order_date'=>$order_date,
											'order_type_id'=>$Ordertypeid,
											'status'=>config::get("common.onstatus"),
											'created_at'=>Carbon::now(),
											'updated_at'=>Carbon::now(),
											'restaurant_id'=>$restaurant_id,
											'customer_id'=>$customer_id,
											'order_status_id'=>$Orderstatusid,
											'customer_address_id'=>$address_type_id);
				
				$storeOrder 	=	Order::storeOrder($insertorders);
				if($storeOrder >= 1)
				{
					$oderhistorydata	=	new Orders_history();
					$oderhistorydata['order_date']	=	$order_date;
					$oderhistorydata['status']		=	config::get("common.onstatus");
					$oderhistorydata['order_status_id']	=	config::get("common.onstatus");
					$oderhistorydata['order_id']	=	$storeOrder;
					$oderhistorydata['created_at']	= 	Carbon::now();
					$oderhistorydata['updated_at']	= 	Carbon::now();
					$oderhistorydata->save();

					foreach($item_id as $key=>$itemidvalue)
					{
						$oderdetailsdata 			=	new Order_details();
						$oderdetailsdata['item_id']	=	$itemidvalue;
						$oderdetailsdata['item_quanitity']	=	$item_quantity[$key];
						$oderdetailsdata['amount']	=	$amount[$key];
						$oderdetailsdata['order_id']=	$storeOrder;
						$oderdetailsdata['status']	=	config::get("common.onstatus");
						$oderdetailsdata->save();
					}
					return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'Successfully Ordered your items'
								]);	
				}
				else
				{
						return response()->json([
											'result'=>config::get("common.offstatus"),
											'message'=>'Successfully not Ordered your items'
										]);	
				}
			}
			else
			{
					return response()->json([
										'result'=>config::get("common.offstatus"),
										'message'=>'Successfully not Ordered your items'
									]);	
			}
		}
		return response()->json([
								'result'=>config::get("common.offstatus"),
								'message'=>'Invalid Access!!'
							]);
	}
	//GET CART ITEMS FOR PARTICULAR CUSTOMER
	public function getOrderItemsHistory()
	{
		$customer_id 	=	input::get('customer_id');
		if($customer_id ==	"")
		{
			return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'Customer id is required'
								]);	
		}
		//AUTHENTICATE FOR CUSTOMER
		$customerauth 		=	app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);
		if($customerauth 	==	"Success")
		{	
			$orderstatusid 	=	13;
			//get order status completed
			$getorderstatus =	Order_status::where('status',config::get("common.onstatus"))->get();
			if(count($getorderstatus) >= 1)
			{
				foreach($getorderstatus as $key=>$statusdesc)
				{
					if($statusdesc->order_status_desc 	==	"Mark as Completed")
					{
						$orderstatusid 	=	$statusdesc->id;
					}
				}
			}
			$getOrderitems  =   Order::getCustomerOrderHistory($customer_id,$orderstatusid);
			$dataorder 		=	array();
			if(!empty($getOrderitems) && count($getOrderitems) >= 1)
			{
				foreach($getOrderitems as $ordes)
				{
					$data['order_date'] 		=	$ordes->order_date;
					$data['id'] 				=	$ordes->id;
					$data['customer_name'] 		=	$ordes->customer_name;
					$data['order_type_name'] 	=	$ordes->order_type_name;
					$data['order_status_desc'] 	=	$ordes->order_status_desc;
					$data['address_type_id'] 	=	$ordes->address_type_id;
					$data['profile_image'] 		=	($ordes->profile_image == null?url(config::get("common.profilenoimage")):$ordes->profile_image);
					$data['customer_id'] 		=	$ordes->customer_id;
					$data['address'] 			=	$ordes->address;
					$data['totalamount'] 		=	$ordes->totalamount;
					array_push($dataorder,$data);
				}
			}
			return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'success',
									'Customerorders'=>$dataorder
								]);		
		}		
		return response()->json([
								'result'=>config::get("common.offstatus"),
								'message'=>'Invalid Access!!'
							]);
	}

	//GET CART ITEMS FOR PARTICULAR CUSTOMER
	public function getPresentOrderItems()
	{
		$customer_id 	=	input::get('customer_id');
		if($customer_id ==	"")
		{
			return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'Customer id is required'
								]);	
		}
		//AUTHENTICATE FOR CUSTOMER
		$customerauth 		=	app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);
		if($customerauth 	==	"Success")
		{			
			$orderstatusid 	=	13;
			//get order status completed
			$getorderstatus =	Order_status::where('status',config::get("common.onstatus"))->get();
			if(count($getorderstatus) >= 1)
			{
				foreach($getorderstatus as $key=>$statusdesc)
				{
					if($statusdesc->order_status_desc 	==	"Mark as Completed")
					{
						$orderstatusid 	=	$statusdesc->id;
					}
				}
			}

			$getOrderitems  =   Order::getCustomerPresentOrderdetails($customer_id,$orderstatusid);
			$dataorder 		=	array();
			if(!empty($getOrderitems) && count($getOrderitems) >= 1)
			{
				foreach($getOrderitems as $ordes)
				{
					$data['order_date'] 		=	$ordes->order_date;
					$data['id'] 				=	$ordes->id;
					$data['customer_name'] 		=	$ordes->customer_name;
					$data['order_type_name'] 	=	$ordes->order_type_name;
					$data['order_status_desc'] 	=	$ordes->order_status_desc;
					$data['address_type_id'] 	=	$ordes->address_type_id;
					$data['profile_image'] 		=	($ordes->profile_image == null?url(config::get("common.profilenoimage")):$ordes->profile_image);
					$data['customer_id'] 		=	$ordes->customer_id;
					$data['address'] 			=	$ordes->address;
					$data['totalamount'] 		=	$ordes->totalamount;
					array_push($dataorder,$data);
				}
			}
			return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'success',
									'Customerorders'=>$dataorder
								]);		
		}		
		return response()->json([
								'result'=>config::get("common.offstatus"),
								'message'=>'Invalid Access!!'
							]);
	}
	//GET CART ITEMS FOR PARTICULAR CUSTOMER
	public function getOrderItemsDetails()
	{
		$customer_id 	=	input::get('customer_id');
		$orderid 		=	input::get('orderid');
		if($customer_id ==	"" || $orderid 	==	"")
		{
			return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'All fields are required'
								]);	
		}
		//AUTHENTICATE FOR CUSTOMER
		$customerauth 		=	app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);

		if($customerauth 	==	"Success")
		{			
			$gettitems  	=   Order_details::getManageOrder($orderid);
			$getamount  	=   $gettitems->sum('amount');
			return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'success',
									'Ordersamount'=>$getamount,
									'CustomerordersItems'=>$gettitems
								]);		
		}		
		return response()->json([
								'result'=>config::get("common.offstatus"),
								'message'=>'Invalid Access!!'
							]);
	}
	//REMOVE CART ITEMS
	public function doRemoveCartItems()
	{
		$customer_id 	=	input::get('customer_id');
		$cart_id 		=	input::get('cart_id');
		if($customer_id ==	"" || $cart_id 	==	"")
		{
			return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'All fields are required'
								]);	
		}
		//AUTHENTICATE FOR CUSTOMER
		$customerauth 		=	app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);

		if($customerauth 	==	"Success")
		{
			//CHECK AMOUNT IS EQUAL OR NOT
			$whereitems 		=	array('status'=>config::get("common.onstatus"),
												'id'=>$cart_id,
												'customers_id'=>$customer_id
											);
			$removecartitems  	=   Carts_details::where($whereitems)->delete();			
			if($removecartitems>=1)
			{
				return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'Successfully removed from cart'
								]);	
			}
			else
			{
				return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'Please try again have some problem!!'
								]);	
			}
				
		}
		return response()->json([
								'result'=>config::get("common.offstatus"),
								'message'=>'Invalid Access!!'
							]);
	}
}