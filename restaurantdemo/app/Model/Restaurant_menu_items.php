<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Restaurant_menu_items extends Model
{
	protected $table ="restaurant_menu_items";

	public static function getRestaurantMenuItems($menuId)
	{
		return Restaurant_menu_items::where('restaurant_menu_items.status','1')
						->select('menu_version','category_name','menu_categories.image_id','item_name as menuItemName','image_url','restaurant_menu_items.id')
						->where('restaurant_menu_items.menu_id',$menuId)
						->join('restaurant_menus','restaurant_menus.id','=','restaurant_menu_items.menu_id')
						->join('menu_categories','menu_categories.id','=','restaurant_menu_items.category_id')
						->join('menu_items','menu_items.id','=','restaurant_menu_items.item_id')
						->join('image_references','image_references.id','=','menu_items.image_id')
						->get();
	}
}
