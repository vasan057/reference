<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model
{
	protected $table= "restaurants";

	protected $fillable = [
		"restaurant_name","address","phone",
	];

	public function restaurant_menu()
	{
		return $this->belongsToMany('App\Model\restaurant_menu');
	}

	//below function will return the full deatils about restaurant join to image table
	public static function getFullRestDetails()
	{
		return restaurant::where('restaurants.status','1')
					->select('restaurants.id as restuarantId','restaurant_name','address','phone_number','about_restaurant','image_url','menu_version')
					->leftjoin('image_references','image_references.id','=','restaurants.image_id')
					->leftjoin('restaurant_menus','restaurants.menu_id','=','restaurant_menus.id')
					->orderBy('restaurants.id','ASC')
					->get();
	}

	public static function getAboutRestaurant($restaurantid)
	{
		return restaurant::where('restaurants.status','1')
					->where('restaurants.id',$restaurantid)
					->leftjoin('image_references','image_references.id','=','restaurants.image_id')
					->get();
	}

	public static function getmenuitmesandimages($collectcategories)
	{
	    return 	DB::table('image_references')
			            			->leftJoin('menu_items', 'image_references.id', '=', 'menu_items.image_id')
			            			->wherein('menu_items.image_id',$collectcategories)
			            			->get();
	}

	public static function getMenuIdOrderView($menuid)
	{
	    return 	DB::table('image_references')
			            			->leftJoin('menu_items', 'image_references.id', '=', 'menu_items.image_id')
			            			->where('menu_items.image_id',$menuid)
			            			->get();
	}

	public static function getRestaurantMenuId($resid,$whereres,$sortby)
	{
	    return 	restaurant::where('restaurants.status','1')
	    					->where('restaurants.id',$resid)
	    					->select('restaurants.id as resid','restaurant_name','menu_items.image_id','menu_items.id as mene_item_id','restaurants.menu_id','category_id','item_id as id','item_name','item_description','item_price','item_type','image_url','image_desc')
			            	->leftJoin('restaurant_menus', 'restaurant_menus.id', '=', 'restaurants.menu_id')
			            	->leftJoin('restaurant_menu_items', 'restaurant_menu_items.menu_id', '=', 'restaurants.menu_id')
			            	->leftJoin('menu_items', 'menu_items.id', '=', 'restaurant_menu_items.item_id')
			            	->leftJoin('image_references', 'image_references.id', '=', 'menu_items.image_id')
			            	->where(function($q) use ($whereres){
									foreach($whereres as $key => $value){
									if(!empty($value))
									{
										$q->wherein($key, $value);
									}
								}
							})
							->orderBy('item_price',$sortby)
			            	->get();
	}

	public static function getRestaurantCategoryFilterId($resid,$category,$whereres,$sortby)
	{
	    return 	restaurant::where('restaurants.status','1')
	    					->where('restaurants.id',$resid)
	    					->where('restaurant_menu_items.category_id',$category)
	    					->select('restaurants.id as resid','restaurant_name','menu_items.image_id','menu_items.id as mene_item_id','restaurants.menu_id','category_id','item_id','item_name','item_description','item_price','item_type','image_url','image_desc')
			            	->leftJoin('restaurant_menus', 'restaurant_menus.id', '=', 'restaurants.menu_id')
			            	->leftJoin('restaurant_menu_items', 'restaurant_menu_items.menu_id', '=', 'restaurants.menu_id')
			            	->leftJoin('menu_items', 'menu_items.id', '=', 'restaurant_menu_items.item_id')
			            	->leftJoin('image_references', 'image_references.id', '=', 'menu_items.image_id')
			            	->where(function($q) use ($whereres){
									foreach($whereres as $key => $value){
									if(!empty($value))
									{
										$q->wherein($key, $value);
									}
								}
							})
							->orderBy('item_price',$sortby)
			            	->get();
	}
}