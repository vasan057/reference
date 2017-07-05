<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\Carts_details;
use App\Model\menu_items;
use App\Model\Image_references;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Cartdetails extends Controller
{
	//ADD CART ITEMS
	public function getAddCartItems()
	{
		$customer_id 	=	input::get('customer_id');
		$item_id 		=	input::get('item_id');
		$noofquantity 	=	input::get('noofquantity');
		$amount 		=	input::get('amount');
		if($customer_id 	==	"" || $item_id 	==	"" || $noofquantity == "" || $amount ==	"")
		{
			return response()->json([
									'result'=>0,
									'message'=>'All Fields are required'
								]);	
		}
		//AUTHENTICATE FOR CUSTOMER
		$customerauth 		=	app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);

		if($customerauth 	==	"Success")
		{
			//CHECK AMOUNT IS EQUAL OR NOT
			$whereitems 			=	array('status'=>1,'id'=>$item_id);
			$Checkitemamount      	=   menu_items::where($whereitems)->first();
			if(!empty($Checkitemamount) && count($Checkitemamount) >= 1)
			{
				$itemamount 		=	$Checkitemamount->item_price;
				$checkquantity 		=	($noofquantity*$itemamount);
				if($checkquantity 	==	$amount)
				{
					$cart 					=	new Carts_details;
			        $cart['item_id'] 		= 	$item_id;
			        $cart['quanitity'] 		= 	$noofquantity;
			        $cart['status'] 		= 	1;
			        $cart['customers_id'] 	= 	$customer_id;
			        $cart['amount'] 		= 	$amount;
			        $success 				=	$cart->save();
					if($success>=1)
					{
						return response()->json([
												'result'=>1,
												'message'=>'Successfully added items to cart'
											]);		
					}
					else
					{
						return response()->json([
												'result'=>0,
												'message'=>'Not Successfully added items to cart,Please try again'
											]);
					}
				}
				else
				{
						return response()->json([
												'result'=>0,
												'message'=>'Amount is Mismatch!!'
											]);
				}
			}
		}
		else
		{
			return response()->json([
									'result'=>0,
									'message'=>'Invalid Access!!'
								]);
		}
	}
	//GET CART ITEMS FOR PARTICULAR CUSTOMER
	public function getCartItemsDetails()
	{
		$customer_id 	=	input::get('customer_id');
		if($customer_id ==	"")
		{
			return response()->json([
									'result'=>0,
									'message'=>'Customer id is required'
								]);	
		}
		//AUTHENTICATE FOR CUSTOMER
		$customerauth 		=	app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);

		if($customerauth 	==	"Success")
		{
			//CHECK AMOUNT IS EQUAL OR NOT
			$whereitems 	=	array('status'=>1,'customers_id'=>$customer_id);
			$Carts_details	=	array();
			$car_data 		=	array();
			$getcartitems  	=   Carts_details::where($whereitems)->get();
			$getcartitems 	=	$getcartitems->sortByDesc('item_id');
			$totalamount 	=	$getcartitems->sum('amount');
			$Carts_itemid 	=	$getcartitems->pluck('item_id');
			$Carts_details 	=	Carts_details::getCartItemDetails($Carts_itemid);
			$Carts_details 	=	$Carts_details->sortByDesc('id');
			foreach($getcartitems as $items)
			{
				foreach($Carts_details as $cartitems)
				{
					if($items['item_id'] 	==	$cartitems->id)
					{
						$Carts_data['item_id'] 		=	$items['item_id'];
						$Carts_data['quanitity'] 	=	$items['quanitity'];
						$Carts_data['customers_id'] =	$items['customers_id'];
						$Carts_data['item_price'] 	=	$cartitems->item_price;
						$Carts_data['amount'] 		=	$items['amount'];
						$Carts_data['cart_id'] 		=	$items['id'];
						$Carts_data['created_at'] 	=	$items['created_at'];
						$Carts_data['item_name'] 	=	$cartitems->item_name;
						$Carts_data['item_description'] 	=	$cartitems->item_description;
						$Carts_data['item_type'] 	=	$cartitems->item_type;
						$Carts_data['image_url'] 	=	$cartitems->image_url;
						$Carts_data['image_desc'] 	=	$cartitems->image_desc;
					}
				}
				array_push($car_data,$Carts_data);
			}
			return response()->json([
									'result'=>1,
									'message'=>'success',
									'Cartamount'=>$totalamount,
									'Cartitems'=>$car_data
								]);		
		}		
		return response()->json([
								'result'=>0,
								'message'=>'Invalid Access!!'
							]);
	}
	//UPDATE CART ITEMS
	public function getUpdateCartItems()
	{
		$customer_id 	=	input::get('customer_id');
		$item_id 		=	input::get('item_id');
		$noofquantity 	=	input::get('noofquantity');
		$amount 		=	input::get('amount');
		$cart_id 		=	input::get('cart_id');
		if($customer_id 	==	"" || $item_id 	==	"" || $noofquantity == "" || $amount ==	"" || $cart_id ==	"")
		{
			return response()->json([
									'result'=>0,
									'message'=>'All Fields are required'
								]);	
		}
		//AUTHENTICATE FOR CUSTOMER
		$customerauth 		=	app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);

		if($customerauth 	==	"Success")
		{
			//CHECK AMOUNT IS EQUAL OR NOT
			$whereitems 			=	array('status'=>1,'id'=>$item_id);
			$Checkitemamount      	=   menu_items::where($whereitems)->first();
			if(!empty($Checkitemamount) && count($Checkitemamount) >= 1)
			{
				$itemamount 		=	$Checkitemamount->item_price;
				$checkquantity 		=	($noofquantity*$itemamount);
				if($checkquantity 	==	$amount)
				{
					$wherecustomeritems 	=	array('status'=>1,
														'id'=>$cart_id,
														'customers_id'=>$customer_id
														);
					$cartupdate 			=	Carts_details::where($wherecustomeritems)->first();
			        if(count($cartupdate)>=1)
			        {
			        	$cartupdate['item_id'] 	= 	$item_id;
				        $cartupdate['quanitity']= 	$noofquantity;
				        $cartupdate['status'] 	= 	1;
				        $cartupdate['customers_id'] 	= 	$customer_id;
				        $cartupdate['amount'] 	= 	$amount;
				        $success 				=	$cartupdate->save();
				        if($success>=1)
						{
							return response()->json([
													'result'=>1,
													'message'=>'Successfully Updated items in cart'
												]);		
						}
						else
						{
							return response()->json([
													'result'=>0,
													'message'=>'Not Successfully Updated items toin cart,Please try again'
												]);
						}
			        }
			        else
			        {
			        	return response()->json([
												'result'=>0,
												'message'=>'Invalid data sending!!'
											]);
			        }
				}
				else
				{
						return response()->json([
												'result'=>0,
												'message'=>'Amount is Mismatch!!'
											]);
				}
			}
		}
		else
		{
			return response()->json([
									'result'=>0,
									'message'=>'Invalid Access!!'
								]);
		}
	}
	//REMOVE CART ITEMS
	public function doRemoveCartItems()
	{
		$customer_id 	=	input::get('customer_id');
		$cart_id 		=	input::get('cart_id');
		if($customer_id ==	"" || $cart_id 	==	"")
		{
			return response()->json([
									'result'=>0,
									'message'=>'All fields are required'
								]);	
		}
		//AUTHENTICATE FOR CUSTOMER
		$customerauth 		=	app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);

		if($customerauth 	==	"Success")
		{
			//CHECK AMOUNT IS EQUAL OR NOT
			$whereitems 		=	array('status'=>1,'id'=>$cart_id,'customers_id'=>$customer_id);
			$removecartitems  	=   Carts_details::where($whereitems)->delete();			
			if($removecartitems>=1)
			{
				return response()->json([
									'result'=>1,
									'message'=>'Successfully removed from cart'
								]);	
			}
			else
			{
				return response()->json([
									'result'=>0,
									'message'=>'Please try again have some problem!!'
								]);	
			}
				
		}
		return response()->json([
								'result'=>0,
								'message'=>'Invalid Access!!'
							]);
	}
}