<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use File;
use App\User;
use App\Model\restaurant;
use App\Model\position;
use App\Model\employee;
use App\Model\customer;
use App\Model\Carts_details;
use App\Model\restaurant_menu;
use App\Model\address_type;
use App\Model\Master_cities;
use App\Model\Customer_addresses;
use App\Model\reservation;

class CustomersController extends Controller
{
	public function manageCustomers(Request $request,$status="",$customerId="")
	{
		if(Input::has('btn_saveCustomer'))
		{
			//dd(md5($request->get('txt_password')));
			$customer 							= new customer();
			$customer->customer_name 			= $request->get('txt_customername');
			$customer->phone 					= $request->get('txt_phone');
			$customer->email 					= $request->get('txt_email');
			$customer->password 				= md5($request->get('txt_password'));
			$customer->phone_number_landline_1 	= $request->get('txt_lnd1');
			$customer->phone_number_landline_2 	= $request->get('txt_lnd2');
			$customer->phone_number_mobile_1 	= $request->get('txt_mbl1');
			$customer->phone_number_mobile_2 	= $request->get('txt_mbl2');
			$customer->phone_number_mobile_3 	= $request->get('txt_mbl3');
			$customer->status 					="1";
			if(Input::hasFile('fl_customerImage'))
			{
				$destinationPath 	= public_path().'assets/img/customer/';
				$file 				= Input::file('fl_customerImage');
				$file_name 			= "customer_".time().".".$file->getClientOriginalExtension();
				$ext 				= $file->getClientOriginalExtension();

				if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
				{
					//dd($imageid[0]->image_id);
					$file->move($destinationPath, $file_name);
					$customer->profile_image 	= url("/assets/img/customer/".$file_name);
				}
			}
			else
			{
				$customer->profile_image 	= "http://www.evinrudenation.com/wp-content/uploads/2012/10/no-image-icon1-200x150.jpg";
			}
			$customer->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateCustomer'))
			{
				$customer 							= customer::find($request->get('txt_id'));
				$customer->customer_name 			= $request->get('txt_customername');
				$customer->phone 					= $request->get('txt_phone');
				$customer->phone_number_landline_1 	= $request->get('txt_lnd1');
				$customer->phone_number_landline_2 	= $request->get('txt_lnd2');
				$customer->phone_number_mobile_1 	= $request->get('txt_mbl1');
				$customer->phone_number_mobile_2 	= $request->get('txt_mbl2');
				$customer->phone_number_mobile_3 	= $request->get('txt_mbl3');
				if(Input::hasFile('fl_customerImage'))
				{
					$destinationPath 	= public_path().'assets/img/customer/';
					$file 				= Input::file('fl_customerImage');
					$file_name 			= "customer_".time().".".$file->getClientOriginalExtension();
					$ext 				= $file->getClientOriginalExtension();

					//dd($customer);

					if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
					{
						$file->move($destinationPath, $file_name);
						File::delete(public_path($customer->profile_image));
						$customer->profile_image 	= url("/assets/img/customer/".$file_name);
						//$menu->image_id = DB::getPdo()->lastInsertId();
					}
				}
				$customer->status 					="1";
				$customer->save();
				return redirect()->action('CustomersController@manageCustomers');
			}
			else
			{
				$customerId 		= decrypt($customerId);
				$customers			= customer::find($customerId);
				//dd($customerId);
				$customerOrders 	= customer::getCustomerOrders($customerId);
				//dd($customerOrders);
				$addressType 		= address_type::where('status','1')->get();
				$city 				= Master_cities::where('status','1')->get();
				$cart 				= Carts_details::getCartDetailsCustomer($customerId);
				$reservation 		= reservation::getReservationStatusCustomer($customerId);
				$customerAddress 	= Customer_addresses::getCustomerDetailsSpecific($customerId);

				return view('admin/editmanageCustomers',compact('customers','addressType','customersAddr','city','customerAddress','customerOrders','cart','reservation'));
			}
		}
		elseif($status == "delete")
		{
			$customers				= customer::find($request->get('txt_customerId'));
			$customers->status 		= "0";
			$customers->save();
			return redirect()->back();
		}
		else
		{
			$customers = customer::getCustomerDetails();
			//dd($customers);
			return view('admin/manageCustomer',compact('customers'));
		}
	}

	public function manageCartItems(Request $request,$status="",$cartItemId="")
	{
		if($status=="delete")
		{
			$cart = Carts_details::find($request->get('txt_cartDetailsId'));
			$cart->status = "0";
			$cart->save();
			return redirect()->back();
		}
	}

	public function managecustomeraddress(Request $request,$status="",$addressId="")
	{
		$addressType 	= address_type::where('status','1')->get();
		$city 			= Master_cities::where('status','1')->get();
		if(Input::has('btn_saveCustomerAddress'))
		{
			$address 					= new Customer_addresses();
			$address->customer_id 		= $request->get('txt_id');
			$address->address 			= $request->get('txtar_address');
			$address->address_type_id 	= $request->get('ddl_addressType');
			$address->latitude 			= $request->get('txt_latitude');
			$address->longitude 		= $request->get('txt_logitude');
			$address->city_id 			= $request->get('ddl_city');
			$address->status 			="1";
			$address->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateCustomerAddress'))
			{
				$address 					= Customer_addresses::find($request->get('txt_id'));
				$address->customer_id 		= $request->get('txt_id');
				$address->address 			= $request->get('txtar_address');
				$address->address_type_id 	= $request->get('ddl_addressType');
				$address->latitude 			= $request->get('txt_latitude');
				$address->longitude 		= $request->get('txt_logitude');
				$address->city_id 			= $request->get('ddl_city');
				$address->status 			="1";
				$address->save();
				return redirect()->action(
    				'CustomersController@manageCustomers', ['status' => 'edit','customerId' => $request->get('txt_customerId')]
					);
				//return redirect()->route('CustomersController@manageCustomers'.'/edit');
			}
			else
			{
				$addressId 			= decrypt($addressId);
				$address			= Customer_addresses::find($addressId);
				return view('admin/editmanageCustomerAddress',compact('address','addressType','city'));
			}
		}
		elseif($status == "delete")
		{
			$address 					= Customer_addresses::find($request->get('txt_customerId'));
			$address->status 			="0";
			$address->save();
			return redirect()->back();
		}
		else
		{
			$customers 		= Customer_addresses::getCustomerDetails();
			return view('admin/manageCustomerAddress',compact('customers','addressType','city'));
		}
	}
}