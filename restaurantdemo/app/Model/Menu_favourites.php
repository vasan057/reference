<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;
class Menu_favourites extends Model
{
	protected $table 	=	"menu_favourites";
	public static function getFavouritesItems($customer_id)
	{
		return Menu_favourites::where('customer_id',$customer_id)
							->select('customer_id','menu_favourites.status as favouritestatus','menu_items.id','item_name','item_description','item_price','item_type','is_gluten_free','is_lactose_free','allergen_info','image_url')
							->join('menu_items','menu_items.id','=','menu_favourites.menu_items_id')
							->join('image_references','image_references.id','=','menu_items.image_id')
							->get();
	}
}