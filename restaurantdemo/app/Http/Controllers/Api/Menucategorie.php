<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\menu_categories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Menucategorie extends Controller
{
	public function index()
	{
		$customers  =   menu_categories::where('status',1)->get();
		return response()->json([
									'customer'=>$customers
								]);	
	}
}