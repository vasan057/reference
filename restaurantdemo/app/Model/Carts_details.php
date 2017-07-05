<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class Carts_details extends Model
{
	protected $table= "carts_details";

    public static function getCartItemDetails($menuid)
	{
	    return 	DB::table('menu_items')
            			->leftJoin('image_references', 'menu_items.image_id', '=', 'image_references.id')
            			->wherein('menu_items.id',$menuid)
            			->get();
	}

	public static function getCartDetailsCustomer($customerId)
	{
		return Carts_details::where('carts_details.status','1')
					->select('item_name','item_description','item_price','image_url','carts_details.quanitity','carts_details.id')
					->where('carts_details.customers_id',$customerId)
					->leftJoin('menu_items','menu_items.id','=','carts_details.item_id')
					->leftJoin('image_references','image_references.id','=','menu_items.image_id')
					->get();
	}

	public static function getFullCartDeatilsCart()
	{
		return Carts_details::where('carts_details.status','1')
					->select('carts_details.id','customer_name','quanitity','amount','item_name')
					->leftjoin('menu_items','menu_items.id','=','carts_details.item_id')
					->leftjoin('customers','customers.id','=','carts_details.customers_id')
					->get();
	}
}