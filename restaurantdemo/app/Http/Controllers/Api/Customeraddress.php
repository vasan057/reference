<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\Customer_addresses;
use App\Model\Master_cities;
use App\Model\Master_states;
use App\Model\customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Customeraddress extends Controller
{
	//GET CART ITEMS FOR PARTICULAR CUSTOMER
	public function getCustomerAddress()
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
			$customerdata 		=	array();
			$whereitems 		=	array('status'=>1,'customer_id'=>$customer_id);
			$Customer_address 	=	Customer_addresses::where($whereitems)->get();
			return response()->json([
									'result'=>1,
									'message'=>'success',
									'Customeraddress'=>$Customer_address
								]);		
		}		
		return response()->json([
								'result'=>0,
								'message'=>'Invalid Access!!'
							]);
	}

	public function store(Request $request)
    {
    	$customer_id 	=	rtrim(input::get('customer_id'),',');
		$name 			=	rtrim(input::get('name'),',');
		$area_name 		=	rtrim(input::get('area_name'),',');
		$building_name 	=	rtrim(input::get('building_name'),',');
		$state_id 		=	input::get('state_id');
		$city_id 		=	input::get('city_id');
		$street_name 	=	rtrim(input::get('street_name'),',');
		$pin_code 		=	input::get('pin_code');
		$address_type 	=	input::get('address_type');
		$check_address 	=	input::get('check_address');
		
		
		if($customer_id 	==	"" || $building_name == "" || $state_id ==	"" || $city_id ==	"" || $street_name ==	"" || $area_name == "" || $pin_code ==	"" || $address_type ==	"" || $check_address ==	"")
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
			$checkaddress 		=	array('status'=>1,
											'customer_id'=>$customer_id,
											'address_type_id'=>$address_type
											);
			$GetAddress      	=   Customer_addresses::where($checkaddress)->first();
			if(!empty($GetAddress) && count($GetAddress) >= 1)
			{
				return response()->json([
										'result'=>1,
										'message'=>'Already you Have address!!'
									]);
			}
			else
			{
				if($name 	==	"")
				{
					$getname 	=	customer::where('id',$customer_id)->first();
					$name 		=	(count($getname)>=1?$getname->customer_name:'');
				}
				//UPDATE CHECKOUT ADDRESS
				if($check_address 	==	1)
				{
					$checkaddress 		=	array('status'=>1,
											'customer_id'=>$customer_id
											);
					$updateAddress 	=   Customer_addresses::where($checkaddress)->update(['checkout_address'=>0]);
				}
				//get city name
				$wherecity 	=	array('id'=>$city_id,'status'=>'Active');
				$getcities 	=	Master_cities::where($wherecity)->first();
				$cityname 	=	(count($getcities)>=1?$getcities->city_name:'');
				//get state name
				$wherestate =	array('id'=>$state_id,'status'=>'Active');
				$getstates 	=	Master_states::where($wherestate)->first();
				$statename 	=	(count($getstates)>=1?$getstates->state_name:'');				
				$address 					=	new Customer_addresses;
			    $address['status'] 			= 	1;
			    $address['customer_id'] 	= 	$customer_id;
			    $address['address'] 		= 	$name.' ,'.$building_name.','.$street_name.','.$area_name.','.$cityname.','.$statename.'-'.$pin_code;
			    $address['address_type_id'] = 	$address_type;
			    $address['checkout_address']= 	$check_address;
			    $success 					=	$address->save();
				if($success>=1)
				{
					return response()->json([
											'result'=>1,
											'message'=>'Successfully Added Address'
										]);		
				}
				else
				{
					return response()->json([
											'result'=>0,
											'message'=>'Not Successfully Address,Please try again'
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

    public function getCustomerCheckoutAddress()
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
			$whereitems 		=	array('status'=>1,'checkout_address'=>1,'customer_id'=>$customer_id);
			$Customer_address 	=	Customer_addresses::where($whereitems)->first();
			return response()->json([
									'result'=>1,
									'message'=>'success',
									'Customeraddress'=>$Customer_address
								]);		
		}		
		return response()->json([
								'result'=>0,
								'message'=>'Invalid Access!!'
							]);
	}

	public function UpdateCustomerAddress()
	{
		$customer_id 	=	rtrim(input::get('customer_id'),',');
		$name 			=	rtrim(input::get('name'),',');
		$area_name 		=	rtrim(input::get('area_name'),',');
		$building_name 	=	rtrim(input::get('building_name'),',');
		$state_id 		=	input::get('state_id');
		$city_id 		=	input::get('city_id');
		$street_name 	=	rtrim(input::get('street_name'),',');
		$pin_code 		=	input::get('pin_code');
		$address_type 	=	input::get('address_type');
		$address_id 	=	input::get('address_id');
		$check_address 	=	input::get('check_address');
		if($customer_id 	==	"" || $building_name == "" || $state_id ==	"" || $city_id ==	"" || $street_name ==	"" || $area_name == "" || $pin_code ==	"" || $address_type ==	"" || $address_id 	==	"" || $check_address == "")
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
			$checkaddress 		=	array('status'=>1,
											'customer_id'=>$customer_id,
											'address_type_id'=>$address_type,
											'id'=>$address_id
											);
			$GetAddress      	=   Customer_addresses::where($checkaddress)->first();
			if(!empty($GetAddress) && count($GetAddress) >= 1)
			{
				if($name 	==	"")
				{
					$getname 	=	customer::where('id',$customer_id)->first();
					$name 		=	(count($getname)>=1?$getname->customer_name:'');
				}
				//UPDATE CHECKOUT ADDRESS
				if($check_address 	==	1)
				{
					$checkaddress 		=	array('status'=>1,
											'customer_id'=>$customer_id
											);
					$updateAddress 	=   Customer_addresses::where($checkaddress)->update(['checkout_address'=>0]);
				}
				//get city name
				$wherecity 	=	array('id'=>$city_id,'status'=>'Active');
				$getcities 	=	Master_cities::where($wherecity)->first();
				$cityname 	=	(count($getcities)>=1?$getcities->city_name:'');
				//get state name
				$wherestate =	array('id'=>$state_id,'status'=>'Active');
				$getstates 	=	Master_states::where($wherestate)->first();
				$statename 	=	(count($getstates)>=1?$getstates->state_name:'');				
			    $GetAddress['status'] 			= 	1;
			    $GetAddress['customer_id'] 	= 	$customer_id;
			    $GetAddress['address'] 		= 	$name.' ,'.$building_name.','.$street_name.','.$area_name.','.$cityname.','.$statename.'-'.$pin_code;
			    $GetAddress['address_type_id'] 	= 	$address_type;
			    $GetAddress['checkout_address'] = 	$check_address;
			    $success 					=	$GetAddress->save();
			    return response()->json([
									'result'=>1,
									'message'=>'Successfully Address is updated!'
								]);
			}
			return response()->json([
									'result'=>0,
									'message'=>'Invalid data sending!!'
								]);
		}
		else
		{
			return response()->json([
									'result'=>0,
									'message'=>'Invalid Access!!'
								]);
		}
	}

	public function doSetPickupAddress()
	{
		$customer_id 	=	input::get('customer_id');
		$address_type 	=	input::get('address_type');
		if($customer_id 	==	"" || $address_type ==	"")
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
			$checkaddress 		=	array('status'=>1,
											'customer_id'=>$customer_id,
											'address_type_id'=>$address_type
											);
			$GetAddress      	=   Customer_addresses::where($checkaddress)->first();
			if(!empty($GetAddress) && count($GetAddress) >= 1)
			{
				//UPDATE CHECKOUT ADDRESS
				$updatecheckaddress 	=	array('status'=>1,
										'customer_id'=>$customer_id
										);
				$updateAddress 		=   Customer_addresses::where($updatecheckaddress)->update(['checkout_address'=>0]);
			   	$updatepickAddress 	=   Customer_addresses::where($checkaddress)->update(['checkout_address'=>1]);
			    return response()->json([
									'result'=>1,
									'message'=>'Successfully set this is Pickup Address!!'
								]);
			}
			return response()->json([
									'result'=>0,
									'message'=>'Please Try Again!!'
								]);
		}
		else
		{
			return response()->json([
									'result'=>0,
									'message'=>'Invalid Access!!'
								]);
		}
	}
	//REMOVE CUSTOMER ADDRESS
	public function doRemoveAddress()
	{
		$customer_id 	=	input::get('customer_id');
		$addresstype_id =	input::get('address_type_id');
		if($customer_id ==	"" || $addresstype_id 	==	"")
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
			$whereaddtype 		=	array('status'=>1,
										'address_type_id'=>$addresstype_id,
										'customer_id'=>$customer_id);
			$removeaddress  	=   Customer_addresses::where($whereaddtype)->delete();			
			if($removeaddress>=1)
			{
				return response()->json([
									'result'=>1,
									'message'=>'Successfully removed Address'
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