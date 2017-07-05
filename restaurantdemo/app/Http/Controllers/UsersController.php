<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Config;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\restaurant;

class UsersController extends Controller
{
	public function manageUser(Request $request,$status = "",$userid="")
	{
		if(Input::has('btn_saveRestaurant'))
		{
			$restaurant 					= new restaurant();
			$restaurant->restaurant_name 	= $request->get('txt_restaurantName');
			$restaurant->address 		 	= $request->get('txt_restaurantAddress');
			$restaurant->phone 				= $request->get('txt_phone');
			$restaurant->status 			= "1";
			$restaurant->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			$restaurant 					= restaurant::where('id',$restaurantId)->get();
			if(Input::has('btn_updateRestaurent'))
			{
				$restaurant 					= restaurant::find($restaurantId);
				$restaurant->restaurant_name 	= $request->get('txt_restaurantName');
				$restaurant->address 		 	= $request->get('txt_restaurantAddress');
				$restaurant->phone 				= $request->get('txt_phone');
				$restaurant->status 			= "1";
				$restaurant->save();
				return redirect()->action('UsersController@manageUser');
			}
			else
			{
				return view('admin/editUser',compact('restaurant'));
			}
		}
		elseif($status == "delete")
		{
			$user 			= user::find($request->get('txt_userId'));
			$user->status 	= config::get("common.offstatus");
			$user->save();
			return redirect()->back();
		}
		elseif($status == "reactive")
		{
			$user 			= user::find($request->get('txt_userId'));
			$user->status 	= config::get("common.onstatus");
			$user->save();
			return redirect()->back();
		}
		else
		{
			$user = user::getUserDetails();
			return view('admin/manageUser',compact('user'));
		}
	}

	public function userChangePassword(Request $request,$status="",$userId="")
	{
		
	}
}