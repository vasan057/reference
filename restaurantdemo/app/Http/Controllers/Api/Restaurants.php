<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\restaurant;
use App\Model\restaurant_menu;
use App\Model\Restaurant_menu_items;
use App\Model\menu_items;
use App\Model\menu_categories;
use App\Model\Banners;
use Config;
use App\Model\Image_references;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Restaurants extends Controller
{
	public function index()
	{
		$restaurant  =   restaurant::where('status',config::get("common.onstatus"))->get();
		return response()->json([
									'restaurant'=>$restaurant
								]);	
	}
	public function restaurant_home()
	{
		//GET FIRST RESTAURANT ID
		$restaurant =   restaurant::where('status',config::get("common.onstatus"))->first();
		$getmenuid 	=	(!empty($restaurant)?$restaurant->menu_id:'');
		if(!empty($getmenuid))
		{
			//RESTAURANT ID MAPPING WITH RESTAURANT MENU TABLE
			$menuidwhere		=	array('status'=>config::get("common.onstatus"),'id'=>$getmenuid);
			$getmenuidvalue 	=	restaurant_menu::where($menuidwhere)->first();
			$menuidvalue		=	(!empty($getmenuidvalue)?$getmenuidvalue->id:'');
			$catemenuidwhere	=	array('status'=>config::get("common.onstatus"),'menu_id'=>$menuidvalue);
			//RESTAURANT MENU TABLE MENU ID MAPPING WITH RESTAURANT MENU ITEMS TABLE
			$getallmenuitems 	=	Restaurant_menu_items::where($catemenuidwhere)->get();
			$categoriesid 		=	$getallmenuitems->unique('category_id');
			$collectcategories 	=	$getallmenuitems->pluck('category_id');
			//CATEGORY ID MAPPING WITH MENU CATEGORIES TABLE
			$firstcategoriesnames 	=	menu_categories::wherein('id',$collectcategories)->first();
			$getfisrtcategoryid	=	(!empty($firstcategoriesnames)?$firstcategoriesnames->id:'');
			//GET ITEMS ID BASED ON CATEGORY ID
			$wherecategory 		=	array('status'=>config::get("common.onstatus"),'category_id'=>$getfisrtcategoryid);
			$restaurantcategory =   Restaurant_menu_items::where($wherecategory)->get();
			$collectmenuitems 	=	$restaurantcategory->pluck('item_id');
			//ITEMS ID MAPPING WITH MENU ITEMS TABLE
			$menuitmename 		=	menu_items::wherein('id',$collectmenuitems)->get();
			$collectmenuitems 	=	$menuitmename->pluck('image_id');
			//$menuitmenames 		=	menu_items::with('Image_references')->get();
			$menuitmenames 		=	restaurant::getmenuitmesandimages($collectmenuitems);
			$categoriesnames 	=	menu_categories::wherein('id',$collectcategories)->get();
			//GET ALL IMAGES FROM BANNERS TABLE
			$getimagebanners 	=	Banners::getSliderBannerDetails();
			return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'Success',
									'restauranthomecategory'=>$categoriesnames,
									'restauranthomemenuitems'=>$menuitmenames,
									'restauranthomebanners'=>$getimagebanners
								]);		
		}
		return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'No Records Found'
								]);
	}

	public function doSearchRestaurant()
	{
		$restaurant_id 	=	input::get('restaurant_id');
		if($restaurant_id == "")
		{
			return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'All fields are required'
								]);	
		}
		//GET FIRST RESTAURANT ID
		$whereres 	=	array('status'=>config::get("common.onstatus"),'id'=>$restaurant_id);
		$restaurant =   restaurant::where($whereres)->first();
		$getmenuid 	=	(!empty($restaurant)?$restaurant->menu_id:'');
		if(!empty($getmenuid))
		{
			//RESTAURANT ID MAPPING WITH RESTAURANT MENU TABLE
			$menuidwhere		=	array('status'=>config::get("common.onstatus"),'id'=>$getmenuid);
			$getmenuidvalue 	=	restaurant_menu::where($menuidwhere)->first();
			$menuidvalue		=	(!empty($getmenuidvalue)?$getmenuidvalue->id:'');
			$catemenuidwhere	=	array('status'=>config::get("common.onstatus"),'menu_id'=>$menuidvalue);
			//RESTAURANT MENU TABLE MENU ID MAPPING WITH RESTAURANT MENU ITEMS TABLE
			$getallmenuitems 	=	Restaurant_menu_items::where($catemenuidwhere)->get();
			$categoriesid 		=	$getallmenuitems->unique('category_id');
			$collectcategories 	=	$categoriesid->pluck('category_id');
			//CATEGORY ID MAPPING WITH MENU CATEGORIES TABLE
			$firstcategoriesnames 	=	menu_categories::wherein('id',$collectcategories)->first();
			
			$getfisrtcategoryid	=	(!empty($firstcategoriesnames)?$firstcategoriesnames->id:'');
			//GET ITEMS ID BASED ON CATEGORY ID
			$wherecategory 		=	array('status'=>config::get("common.onstatus"),'category_id'=>$getfisrtcategoryid);
			$restaurantcategory =   Restaurant_menu_items::where($wherecategory)->get();
			$collectmenuitems 	=	$restaurantcategory->pluck('item_id');
			//ITEMS ID MAPPING WITH MENU ITEMS TABLE
			$menuitmename 		=	menu_items::wherein('id',$collectmenuitems)->get();
			$collectmenuitems 	=	$menuitmename->pluck('image_id');
			//$menuitmenames 		=	menu_items::with('Image_references')->get();
			$menuitmenames 		=	restaurant::getmenuitmesandimages($collectmenuitems);
			$categoriesnames 	=	menu_categories::wherein('id',$collectcategories)->get();
			//GET ALL IMAGES FROM BANNERS TABLE
			$getimagebanners 	=	Banners::getSliderBannerDetails();
			return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'Success',
									'restauranthomecategory'=>$categoriesnames,
									'restauranthomemenuitems'=>$menuitmenames,
									'restauranthomebanners'=>$getimagebanners
								]);		
		}
		return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'No Records Found'
								]);
	}

	public function getCategoriesMenuItems()
	{
		$categories_id 		=	input::get('category_id');
		if($categories_id 	==	"")
		{
			return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'Category id is required'
								]);	
		}
		$wherecategory 		=	array('status'=>config::get("common.onstatus"),'category_id'=>$categories_id);
		$restaurant 		=   Restaurant_menu_items::where($wherecategory)->get();
		$collectmenuitems 	=	$restaurant->pluck('item_id');
		$menuimage_id 		=	menu_items::wherein('id',$collectmenuitems)->get();
		$collectcategories 	=	$menuimage_id->pluck('image_id');
		$menuitmenames 		=	restaurant::getmenuitmesandimages($collectcategories);
		if(!empty($menuitmenames)  && count($menuitmenames)>=1)
		{
			return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'success',
									'restaurantmenuitems'=>$menuitmenames
								]);		
		}
		return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'failure'
								]);	
	}
	public function doViewMenuitemId()
	{
		$menu_id 		=	input::get('menu_id');
		if($menu_id 	==	"")
		{
			return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'Menu id is required'
								]);	
		}
		$menuvieworder 		=	restaurant::getMenuIdOrderView($menu_id);
		if(!empty($menuvieworder) && count($menuvieworder)>=1)
		{
			return response()->json([
									'result'=>config::get("common.onstatus"),
									'message'=>'success',
									'restauranthome'=>$menuvieworder
								]);	
		}
		return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'failure'
								]);
	}

	public function doViewAboutRestaurant()
	{
		$restaurantid 		=	input::get('restaurantid');
		if($restaurantid 	==	"")
		{
			return response()->json([
									'result'=>config::get("common.offstatus"),
									'message'=>'Restaurant id is required'
								]);	
		}
		$viewrestaurant 	=	restaurant::getAboutRestaurant($restaurantid);
		return response()->json([
								'result'=>config::get("common.onstatus"),
								'message'=>'success',
								'restaurantaboutus'=>$viewrestaurant
							]);	
	}
}