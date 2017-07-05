<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\restaurant_menu;
use App\Model\menu_items;
use App\Model\Restaurant_menu_items;
use App\Model\restaurant;
use App\Model\menu_categories;
use App\Model\Image_references;
use Carbon\Carbon;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Filters extends Controller
{
	//FILTER MENU ITEMS
	public function getFilterItems()
	{
		$customer_id 	=	input::get('customer_id');
		$restaurant_id 	=	input::get('restaurant_id');
		$foodList 		=	input::get('foodList');
		$pricelist 		=	input::get('pricelist');
		if($customer_id ==	"" || $restaurant_id == "")
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
			switch($foodList)
			{
				case 'veg':
				$data['item_type'] 	=	["Vegetarian"];
				break;
				case 'nonveg':
				$data['item_type'] 	=	["Non-vegetarian"];
				break;
				case 'both':
				
				$data['item_type'] 	=	["Vegetarian","Non-vegetarian"];
				break;
				default:
				$data['item_type'] 	=	["Non-vegetarian"];
			}		
			$sortby 	=	'asc';	
			if(!empty($pricelist))
			{				
				switch($pricelist)
				{
					case 'htl':
					$sortby 	=	'desc';
					break;
					case 'lth':
					$sortby 	=	'asc';
					break;
					default:
					$sortby 	=	'asc';
				}	
			}
			//RESTAURANT ID MAPPING WITH RESTAURANT MENU TABLE
			$getrestaurantmenuid 	=	restaurant::getRestaurantMenuId($restaurant_id,$data,$sortby);

			return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'success',
									'Filtermenus'=>$getrestaurantmenuid
								]);	
		}		
		return response()->json([
								'result'=>config::get("common.offstatus"),
								'message'=>'Invalid Access!!'
							]);
	}

	//FILTER MENU ITEMS BASED ON CATEOGRY ID
	public function getFilterCategoryItems()
	{
		$customer_id 	=	input::get('customer_id');
		$restaurant_id 	=	input::get('restaurant_id');
		$category_id 	=	input::get('category_id');
		$foodList 		=	input::get('foodList');
		$pricelist 		=	input::get('pricelist');
		if($customer_id ==	"" || $restaurant_id == "" || $category_id == "")
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
			switch($foodList)
			{
				case 'veg':
				$data['item_type'] 	=	["Vegetarian"];
				break;
				case 'nonveg':
				$data['item_type'] 	=	["Non-vegetarian"];
				break;
				case 'both':
				
				$data['item_type'] 	=	["Vegetarian","Non-vegetarian"];
				break;
				default:
				$data['item_type'] 	=	["Non-vegetarian"];
			}		
			$sortby 	=	'asc';	
			if(!empty($pricelist))
			{				
				switch($pricelist)
				{
					case 'htl':
					$sortby 	=	'desc';
					break;
					case 'lth':
					$sortby 	=	'asc';
					break;
					default:
					$sortby 	=	'asc';
				}	
			}
			//RESTAURANT ID MAPPING WITH RESTAURANT MENU TABLE
			$getrestaurantmenuid 	=	restaurant::getRestaurantCategoryFilterId($restaurant_id,$category_id,$data,$sortby);

			return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'success',
									'Filtercategoryitems'=>$getrestaurantmenuid
								]);	
		}		
		return response()->json([
								'result'=>config::get("common.offstatus"),
								'message'=>'Invalid Access!!'
							]);
	}
}