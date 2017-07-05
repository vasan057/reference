<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use File;
use Config;
use App\User;
use App\Model\restaurant;
use App\Model\position;
use App\Model\employee;
use App\Model\restaurant_menu;
use App\Model\menu_items;
use App\Model\Master_cities;
use App\Model\menu_categories;
use App\Model\Order_type;
use App\Model\Order;
use App\Model\customer;
use App\Model\Order_status;
use App\Model\Order_details;
use App\Model\Restaurant_menu_items;
use App\Model\Customer_addresses;
use App\Model\Image_references;
use App\Model\orders_history;
use App\Model\user_type;

class adminController extends Controller
{

	public function manageRestaurents(Request $request,$status = "",$restaurantId="")
	{
		$user 		= user::where('status',config::get("common.onstatus"))->get();
			//dd($restaurant);
		$menu 		= restaurant_menu::where('status',config::get("common.onstatus"))->get();
		$city 		= Master_cities::where('status',config::get("common.onstatus"))->get();
		if(Input::has('btn_saveRestaurant'))
		{
			$restaurant 						 = new restaurant();
			$restaurant->restaurant_name 		 = $request->get('txt_restaurantName');
			$restaurant->address 		 		 = $request->get('txt_restaurantAddress');
			$restaurant->latitude 				 = $request->get('txt_latitude');
			$restaurant->longitude 				 = $request->get('txt_longitude');
			$restaurant->phone_number 			 = $request->get('txt_phone');
			$restaurant->menu_id 				 = $request->get('ddl_menu');
			$restaurant->about_restaurant		 = $request->get('txtar_restDesc');
			$restaurant->user_id 				 = $request->get('ddl_users');
			$restaurant->city_id				 = $request->get('ddl_city');
			$restaurant->opening_hours 			 = $request->get('txt_openinghr');
			$restaurant->closing_hours 			 = $request->get('txt_closinghr');
			$restaurant->delivery_opening_hours  = $request->get('txt_delopenhr');
			$restaurant->delivery_closing_hours  = $request->get('txt_delclosehr');
			$restaurant->price_range_info 		 = $request->get('txt_priceRange');
			$restaurant->min_home_delivery_amount= $request->get('txt_minHomeDelivery');
			$restaurant->average_rating 		 = $request->get('txt_rating');
			$restaurant->directions 			 = $request->get('txt_direct');
			if($request->get('chk_homeDelivery') != "1")
			{
				$homeDel = "0";
			}
			else
			{
				$homeDel ="1";
			}

			if($request->get('chk_tableBooking') != "1")
			{
				$tableBook = "0";
			}
			else
			{
				$tableBook= "1";
			}

			if($request->get('chk_pickup') != "1")
			{
				$has_pickup = "0";
			}
			else
			{
				$has_pickup = "1";
			}
			$restaurant->has_home_delivery 			= $homeDel;
			$restaurant->has_table_booking 			= $tableBook;
			$restaurant->has_pickup 				= $has_pickup;

			if(Input::hasFile('fl_restImg'))
			{
				$destinationPath 	= public_path().'/assets/img/restaurant/';
				$file 				= Input::file('fl_restImg');
				$file_name 			= "restaurant_" . time() . ".".$file->getClientOriginalExtension();
				$ext 				= $file->getClientOriginalExtension();

				if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
				{
					$file->move($destinationPath, $file_name);
					DB::table('image_references')->insert([
							'image_url' => url("/assets/img/restaurant/".$file_name),
							'status'	=> '1',
							'image_desc'=>$request->get('txt_restaurantName')
						]);
					$restaurant->image_id = DB::getPdo()->lastInsertId();
				}
			}
			elseif($request->get('txt_manageImg') != "")
			{
				DB::table('image_references')->insert([
							'image_url' => $request->get('txt_manageImg'),
							'status'	=> '1',
							'image_desc'=>$request->get('txt_restaurantName')
						]);
				$restaurant->image_id = DB::getPdo()->lastInsertId();
			}
			else
			{
				DB::table('image_references')->insert([
							'image_url' => "http://www.evinrudenation.com/wp-content/uploads/2012/10/no-image-icon1-200x150.jpg",
							'status'	=>"1",
							'image_desc'=>$request->get('txt_restaurantName')
						]);
				$restaurant->image_id = DB::getPdo()->lastInsertId();
			}

			$restaurant->status 			= config::get("common.onstatus");
			$restaurant->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateRestaurent'))
			{
				//dd($request->get('txt_id'));
				$imageid 								= restaurant::where('id',$request->get('txt_id'))->get();
				//dd($imageid);
				$restaurant 							= restaurant::find($request->get('txt_id'));
				$restaurant->restaurant_name 			= $request->get('txt_restaurantName');
				$restaurant->address 		 			= $request->get('txt_restaurantAddress');
				$restaurant->latitude 					= $request->get('txt_latitude');
				$restaurant->longitude 				 	= $request->get('txt_longitude');
				$restaurant->phone_number 				= $request->get('txt_phone');
				$restaurant->menu_id 					= $request->get('ddl_menu');
				$restaurant->about_restaurant			= $request->get('txtar_restDesc');
				$restaurant->user_id 					= $request->get('ddl_users');
				$restaurant->city_id					= $request->get('ddl_city');
				$restaurant->opening_hours 				= $request->get('txt_openinghr');
				$restaurant->closing_hours 				= $request->get('txt_closinghr');
				$restaurant->delivery_opening_hours 	= $request->get('txt_delopenhr');
				$restaurant->delivery_closing_hours 	= $request->get('txt_delclosehr');
				$restaurant->price_range_info 			= $request->get('txt_priceRange');
				$restaurant->min_home_delivery_amount 	= $request->get('txt_minHomeDelivery');
				$restaurant->average_rating 			= $request->get('txt_rating');
				$restaurant->directions 				= $request->get('txt_direct');
				if($request->get('chk_homeDelivery') != "1")
				{
					$homeDel = "0";
				}
				else
				{
					$homeDel ="1";
				}

				if($request->get('chk_tableBooking') != "1")
				{
					$tableBook = "0";
				}
				else
				{
					$tableBook= "1";
				}

				if($request->get('chk_pickup') != "1")
				{
					$has_pickup = "0";
				}
				else
				{
					$has_pickup = "1";
				}
				$restaurant->has_home_delivery 			= $homeDel;
				$restaurant->has_table_booking 			= $tableBook;
				$restaurant->has_pickup 				= $has_pickup;

				if(Input::hasFile('fl_restImg'))
				{
					$destinationPath 	= public_path().'/assets/img/restaurant/';
					$file 				= Input::file('fl_restImg');
					$file_name 			= "restaurant_".time().".".$file->getClientOriginalExtension();
					$ext 				= $file->getClientOriginalExtension();

					if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
					{
						//dd($imageid[0]->image_id);
						$file->move($destinationPath, $file_name);
						DB::table('image_references')
									->where('id',$imageid[0]->image_id)
									->update([
										'image_url' => url("/assets/img/restaurant/".$file_name),
										'image_desc'=> $request->get('txt_restaurantName')
									]);
					}
				}

				$restaurant->status 			= config::get("common.onstatus");
				$restaurant->save();
				return redirect()->action('adminController@manageRestaurents');
			}
			else
			{
				$restaurantId 		=  decrypt($restaurantId);
				//dd($restaurantId);
				$restaurant 		= restaurant::find($restaurantId);
				return view('admin/editRestaurents',compact('restaurant','menu','user','city'));
			}
		}
		elseif($status == "delete")
		{
			$restaurant 				= restaurant::find($request->get('txt_restaurantId'));
			$restaurant->status 		=config::get("common.offstatus");
			$restaurant->save();
			return redirect()->back();
		}
		else
		{
			$restaurant = restaurant::getFullRestDetails();
			$images 	= Image_references::wherestatus('1')->paginate(1);
			//$paginatelink = $images->links();
			$locationsdb 	= DB::table('restaurants')
								->select('restaurant_name','latitude','longitude')
								->wherestatus('1')
								->get();
			//dd($locations);
			return view('admin/manageRestaurents',compact('restaurant','menu','user','city','images','locationsdb'));
		}
	}

	public function addNewRestaurant(Request $request)
	{
		$restaurant = restaurant::getFullRestDetails();
		$images 	= Image_references::wherestatus('1')->paginate(5);

		$locations 	= DB::table('restaurants')
							->select('restaurant_name','latitude','longitude')
							->wherestatus('1')
							->get();
		$user 		= user::where('status',config::get("common.onstatus"))->get();

		if ($request->ajax()) 
		{
        	return view('admin/manageImages', compact('images'));
    	}

		$menu 		= restaurant_menu::where('status',config::get("common.onstatus"))->get();
		$city 		= Master_cities::where('status',config::get("common.onstatus"))->get();

		return view('admin.addnewrestaurant',compact('restaurant','menu','user','city','images','locations'));
	}

	public function managePositions(Request $request,$status="",$positionId="")
	{

		if(Input::has('btn_savePosition') && ($status == "Add"))
		{
			$positions 					=  new position();
			$positions->position_title 	= $request->get('txt_positionName');
			$positions->status 			= config::get("common.onstatus");
			$positions->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_update'))
			{
				$position 					= position::find($request->get('txt_id'));
				$position->position_title 	= $request->get('txt_positionName');
				$position->status 			= config::get("common.onstatus");
				$position->save();
				return redirect()->action('adminController@managePositions');
			}
			else
			{
				$positionId 				= decrypt($positionId);
				$getData 					= position::find($positionId);
				return view('admin/editPositions',compact('positionId','getData'));
			}
		}
		else
		{
			$position = position::where('status','1')->get();
			return view('admin/managePositions',compact('position'));
		}
	}

	public function manageEmployees(Request $request,$status="",$employeeId="")
	{
		$position 	= position::where('status',config::get("common.onstatus"))->get();
		$city 		= Master_cities::where('status',config::get("common.onstatus"))->get();
		$restaurant = restaurant::where('status',config::get("common.onstatus"))->get();

		if(Input::has('btn_saveEmployee'))
		{
			$usr 						= new User();
			$usr->name 					= $request->get('txt_empName');
			$usr->email 				= $request->get('txt_email');
			$usr->password 				= md5($request->get('txt_password'));
			$usr->user_types_id 		= $request->get('ddl_position');
			$usr->status 				= config::get('onstatus');
			$usr->phone_number 			= $request->get('txt_phno');
			$usr->user_present_status 	= 'online';
			$usr->restaurant_id 		= $request->get('ddl_restaurant');
			$usr->save();
			// $emp 				= new employee();
			// $emp->employee_name = $request->get('txt_empName');
			// $emp->address 		= $request->get('txtar_address');
			// $emp->phone 		= $request->get('txt_phno');
			// $emp->position_id 	= $request->get('ddl_position');
			// $emp->restaurant_id = $request->get('ddl_restaurant');
			// $emp->city_id 		= $request->get('ddl_city');
			// $emp->status 		= config::get("common.onstatus");
			// $emp->save();
			return redirect()->action('adminController@manageEmployees');
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateEmployee'))
			{
				$emp 				= employee::find($request->get('txt_id'));
				$emp->employee_name = $request->get('txt_employeeName');
				$emp->address 		= $request->get('txtar_addr');
				$emp->phone 		= $request->get('txt_phno');
				$emp->position_id 	= $request->get('ddl_position');
				$emp->restaurant_id = $request->get('ddl_restaurant');
				$emp->city_id 		= $request->get('ddl_city');
				$emp->status 		= config::get("common.onstatus");
				$emp->save();
				return redirect()->action('adminController@manageEmployees');
			}
			else
			{
				$employeeId = decrypt($employeeId);
				$user 		= employee::find($employeeId);
				//dd($employeeId);
				return view('admin/editEmployees',compact('user','position','city','restaurant'));
			}
			
		}
		elseif($status == "delete")
		{
			$emp 			= employee::find($request->get('txt_employeeId'));
			$emp->status 	= config::get("common.offstatus");
			$emp->save();
			return redirect()->back();
		}
		else
		{
			//$user 		= employee::position()->where('status','1')->get();
			//$user 		= employee::getFullEmployee();
			$user 			= user::getUserDetails();
			$user_type 		= user_type::all();
			//dd($user);
			return view('admin/manageEmployees',compact('user','position','city','restaurant','user_type'));
		}
	}

	public function changePassword(Request $request)
	{
		if(Input::has('btn_changePassword'))
		{
			//dd('0');
			$this->validate($request, 
			[
				'txt_oldPassword' => 'required',
				'txt_newPassword' => 'required',
				'txt_confirmPassword' => 'required|same:txt_confirmPassword',
			]);
			$myDets 		= user::find(Auth::User()->id);
			$oldPassword 	= $myDets->password;
			//dd($myDets);
			if(hash::check($request->get('txt_oldPassword'),$oldPassword))
			{
				//dd('2');
				$myDets->fill([
                	'password' => Hash::make($request->get('newPassword'))
            	])->save();
            	\Session::flash('flash_message', 'Password Changed Successfully');
				return redirect()->back();
			}
			else
			{
				//dd('1');
				\Session::flash('wrong_message', 'OldPassword is not correct');
				return redirect()->back();
			}
		}
		else
		{
			return view('admin/changePassword');
		}
	}

}