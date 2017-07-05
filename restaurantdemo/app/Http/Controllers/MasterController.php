<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use App\User;
use App\Model\address_type;
use App\Model\restaurant_menu;
use App\Model\Master_countries;
use App\Model\Master_states;
use App\Model\Master_cities;

class MasterController extends Controller
{

	public function manageAddressTypes(Request $request,$status = "",$addressId="")
	{
		if(Input::has('btn_saveAddressTypes'))
		{
			$addressType 					= new address_type();
			$addressType->address_type_desc	= $request->get('txt_addresstype');
			$addressType->status 			= "1";
			$addressType->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateAddressTypes'))
			{
				//$restaurant 					= restaurant::find($restaurantId);
				$addressType 					= address_type::find($request->get('txt_id'));
				$addressType->address_type_desc	= $request->get('txt_addresstype');
				$addressType->status 			= "1";
				$addressType->save();
				return redirect()->action('MasterController@manageAddressTypes');
			}
			else
			{
				$addressId 				= decrypt($addressId);
				$addressType 			= address_type::find($addressId);
				return view('admin/editAddressTypes',compact('addressType'));
			}
		}
		elseif($status == "delete")
		{
			$addressType 			= address_type::find($request->get('txt_addressTypeId'));
			$addressType->status 	= "0";
			$addressType->save();
			return  redirect()->back();
		}
		else
		{
			$address = address_type::where('status','1')->get();
			return view('admin/manageAddressTypes',compact('address'));
		}
	}

	public function manageMasterCountry(Request $request,$status="",$countryId="")
	{
		if(Input::has('btn_addCountry'))
		{
			$country 				= new Master_countries();
			$country->country_name = $request->get('txt_countryname');
			$country->status 		="1";
			$country->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_update'))
			{
				$country 				= Master_countries::find($request->get('txt_id'));
				$country->country_name 	= $request->get('txt_countryname');
				$country->status 		="1";
				$country->save();
				return redirect()->action('MasterController@manageMasterCountry');
			}
			else
			{
				$countryId 			= decrypt($countryId);
				//dd()
				$country 			= Master_countries::find($countryId);
				return view('admin/editMasterCountry',compact('country'));
			}
		}
		elseif($status == "delete")
		{
			$country 				= Master_countries::find($request->get('txt_countryId'));
			//$country->country_name 	= $request->get('txt_countryname');
			$country->status 		="0";
			$country->save();
			return redirect()->back();
		}
		else
		{
			$country = Master_countries::where('status','1')->get();
			//dd($country);
			return view('admin/manageMasterCounty',compact('country'));
		}
	}

	public function manageMasterState(Request $request,$status="",$stateId="")
	{
		$country = Master_countries::where('status','1')->get();
		if(Input::has('btn_StateSave'))
		{
			$state 					= new Master_states();
			$state->country_id 		= $request->get('ddl_country');
			$state->state_name 		= $request->get('txt_statename');
			$state->status 			="1";
			$state->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_update'))
			{
				$state 					= Master_states::find($request->get('txt_id'));
				$state->country_id 		= $request->get('ddl_country');
				$state->state_name 		= $request->get('txt_statename');
				$state->status 			="1";
				$state->save();
				return redirect()->action('MasterController@manageMasterState');
			}
			else
			{
				$stateId 			= decrypt($stateId);
				//dd($stateId);
				$state 				= Master_states::find($stateId);
				//dd($state);
				//dd($state);
				return view('admin/editMasterState',compact('state','country'));
			}
		}
		elseif($status == "delete")
		{
			$state 					= Master_states::find($request->get('txt_stateId'));
			$state->status 			="0";
			$state->save();
			return redirect()->back();
		}
		else
		{
			$states = Master_states::getCity();
			//dd($states);
			return view('admin/manageMasterState',compact('states','country'));
		}
	}

	public function manageMasterCity(Request $request,$status="",$cityId="")
	{
		$country 	= Master_countries::where('status','1')->get();
		if(Input::has('btn_saveCity'))
		{
			$city 					= new Master_cities();
			$city->state_id 		= $request->get('ddl_state');
			$city->city_name 		= $request->get('txt_cityname');
			$city->popular_status 	= $request->get('ddl_popularStatus');
			$city->status 			="1";
			$city->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateCity'))
			{
				$city 					= Master_cities::find($request->get('txt_id'));
				$city->state_id 		= $request->get('ddl_state');
				$city->city_name 		= $request->get('txt_cityname');
				$city->popular_status 	= $request->get('ddl_popularStatus');
				$city->status 			="1";
				$city->save();
				return redirect()->action('MasterController@manageMasterCity');
			}
			else
			{
				$cityId 			= decrypt($cityId);
				$city 				= Master_cities::getStateCountry($cityId);
				$allstates 			= Master_states::where('status','1')->get();
				//dd($city);
				return view('admin/editMasterCity',compact('city','country','allstates'));
			}
		}
		elseif($status == "delete")
		{
			$city 					= Master_cities::find($request->get('txt_cityId'));
			$city->status 			="0";
			$city->save();
			return redirect()->back();
		}
		else
		{
			$city 		= Master_cities::getState();
			//dd($city);
			return view('admin/manageMasterCity',compact('city','country'));
		}
	}

	public function getState(Request $request)
	{
		$states = Master_states::where('country_id',$request->country_id)->get();
		return response()->json($states);
	}

}