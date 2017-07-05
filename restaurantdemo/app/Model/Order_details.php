<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class Order_details extends Model
{
	protected $table ="order_details";

	//this function is used manageorder deatils view inside admincontroller line 606
	public static function getManageOrder($orderId = "")
	{
		return Order_details::where('order_details.order_id',$orderId)
						->select('order_details.id','order_status_desc','item_name','item_price','image_url','item_quanitity','amount')
						->leftjoin('menu_items','menu_items.id','=','order_details.item_id')
						->leftjoin('orders','orders.id','=','order_details.order_id')
						->leftjoin('order_status','order_status.id','=','orders.order_status_id')
						//->leftjoin('orders_history','orders_history.order_id','=','orders.id')
						->leftjoin('image_references','image_references.id','=','menu_items.image_id')
						->where('order_details.status','1')
						->get();
	}
}