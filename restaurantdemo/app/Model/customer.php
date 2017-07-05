<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Order;
use DB;

class customer extends Model
{
	protected $table = "customers";

	public static function doCheckExistMobile($where,$id)
	{
		return customer::where($where)->where('id','<>',$id)->get();
	}

	public static function doCheckExistEmail($where,$id)
	{
		return customer::where($where)->where('id','<>',$id)->get();
	}

	public static function getCustomerOrders($customerId)
	{
		return Order::where('orders.status','1')
						->select('order_type_name','restaurant_name','customer_name','customer_addresses.address','order_status_desc','item_quanitity','amount','orders.created_at','item_name','item_price',DB::raw('SUM(item_quanitity) as TotalQuantity'),DB::raw('SUM(item_quanitity*amount) as TotalPrice'))
						->where('orders.customer_id',$customerId)
						->leftjoin('order_details','order_details.order_id','=','orders.id')
						 ->leftjoin('order_types','order_types.id','=','orders.order_type_id')
						 ->leftjoin('restaurants','restaurants.id','=','orders.restaurant_id')
						 ->leftjoin('customers','customers.id','=','orders.customer_id')
						 ->leftjoin('order_status','order_status.id','=','orders.order_status_id')
						 ->leftjoin('customer_addresses','customer_addresses.id','=','orders.customer_address_id')
						->leftjoin('menu_items','menu_items.id','=','order_details.item_id')
						->groupBy('order_details.order_id')
						->get();
	}

	public static function getCustomerDetails()
	{
		return customer::where('customers.status','1')
					->orwhere('customer_addresses.status','1')
					->select('customers.id','customer_name','phone','email',DB::raw('COUNT(carts_details.item_id) as customerCartCount1'),DB::raw('COUNT(address) as customerAddrCount'),DB::raw('COUNT(carts_details.item_id) as customerCartCount2'))
					->leftjoin('carts_details','carts_details.customers_id','=','customers.id')
					->leftjoin('customer_addresses','customer_addresses.customer_id','=','customers.id')
					->groupBy('customers.id')
					->get();
	}
}