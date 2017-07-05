<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\reservation;
use App\Model\dining_table;
use Carbon\Carbon;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Tablebooking extends Controller
{
	//ADD CART ITEMS
	public function store()
	{
		$customer_id 		=	input::get('customer_id');
		$restaurant_id 		=	input::get('restaurant_id');
		$booking_date 		=	input::get('booking_date');
		$booking_time 		=	input::get('booking_time');
		$no_fo_seats 		=	input::get('no_fo_seats');
		if($customer_id ==	"" || $restaurant_id ==	"" || $booking_date ==	"" || $booking_time ==	""	|| $no_fo_seats ==	"")
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
			//SAVE ORDER TYPE 
			$insertdata 			=	array('table_name'=>'',
												'chairs_count'=>$no_fo_seats,
												'status'=>1,
												'status_id'=>'',
												'section_id'=>'',
												'restaurant_id'=>$restaurant_id
											);
			$diningtable 			=	dining_table::storeDiningtable($insertdata);
			if($diningtable >= 1)
			{
				if(!empty($item_id) && count($item_id) >= 1)
				{
					$reservation 	=	new reservation();
					$reservation['reservation_date'] 	=	$booking_date;
					$reservation['customer_id'] 		=	$customer_id;
					$reservation['dining_table_id'] 	=	$diningtable;
					$reservation['status'] 				=	1;
					$bookedtable 	=	$reservation->save();
					return response()->json([
								'result'=>1,
								'message'=>'Successfully A Booked Table'
							]);	
				}
				return response()->json([
												'result'=>0,
												'message'=>'Successfully Not A Booked Table'
											]);	
			}
			else
			{
					return response()->json([
										'result'=>0,
										'message'=>'Successfully Not A Booked Table'
									]);	
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
	public function getOrderItemsHistory()
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
			$getOrderitems  =   Order::getCustomerOrderHistory($customer_id);
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
									'result'=>1,
									'message'=>'success',
									'Customerorders'=>$dataorder
								]);		
		}		
		return response()->json([
								'result'=>0,
								'message'=>'Invalid Access!!'
							]);
	}
}