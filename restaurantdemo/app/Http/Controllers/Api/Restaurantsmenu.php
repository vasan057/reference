<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\restaurant_menu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Restaurantsmenu extends Controller
{
	public function index()
	{
		$restaurant  =   restaurant_menu::where('status',1)->get();
		return response()->json([
									'restaurant_menu'=>$restaurant
								]);	
	}
	public function restaurant_home()
	{
		$restaurant  =   restaurant_menu::where('status',1)->first();
		return response()->json([
									'restauranthome'=>$restaurant
								]);	
	}
}