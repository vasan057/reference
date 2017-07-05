<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class delivery_track extends Model
{
	protected $table = "delivery_tracks";

	public static function getDeliveryTracks()
	{
		return delivery_track::where('delivery_tracks.status','1')
						->select('estimated_time','customer_name','delivery_tracks.id as deliveryId','bills.id as billId','order_status_desc')
						->leftjoin('customers','customers.id','=','delivery_tracks.customer_id')
						->leftjoin('bills','bills.id','=','delivery_tracks.bill_id')
						->leftjoin('order_status','order_status.id','=','delivery_tracks.order_status_id')
						->get();
	}

	public static function getCustomerDeliveryTracks($customerid,$orderid)
	{
		return delivery_track::where('delivery_tracks.status','1')
						->where('delivery_tracks.customer_id',$customerid)
						->where('bills.order_id',$orderid)
						->where('bills.status','1')
						->select('customer_id','bill_id','latitude','longitude','order_id')
						->leftjoin('bills','bills.id','=','delivery_tracks.bill_id')
						->get();
	}

	public static function getDeliveryBoyOrders($userid)
	{
		return delivery_track::where('delivery_tracks.status','1')
						->where('delivery_tracks.status',1)
						->where('bills.status',1)
						->where('orders.status',1)
						->where('restaurants.status',1)
						->where('delivery_tracks.users_id',$userid)
						->where('delivery_tracks.order_status_id',4)
						->where('bills.status','1')
						->select('restaurant_name','delivery_tracks.customer_id','delivery_tracks.bill_id','address','phone_number','restaurants.latitude','restaurants.longitude','orders.id','order_type_name',DB::raw('SUM(order_details.amount) as totalamount'))
						->leftjoin('bills','bills.id','=','delivery_tracks.bill_id')
						->leftjoin('restaurants','restaurants.id','=','bills.restaurant_id')
						->leftjoin('orders','orders.id','=','bills.order_id')
						->leftjoin('order_types','order_types.id','=','orders.order_type_id')
						->leftjoin('order_details','order_details.order_id','=','orders.id')
						->groupBy('orders.id')
						->get();
	}

	public static function getDeliveryOrderdetails($orderId = "")
	{
		return Order_details::where('order_id',$orderId)
						->where('order_details.status','1')
						->where('checkout_address','1')
						->select('customers.id as customer_id','customer_name','address','customers.phone','customer_addresses.latitude as latitude','customer_addresses.longitude as longitude','order_details.id','item_name','item_price','item_quanitity','amount')
						->leftjoin('menu_items','menu_items.id','=','order_details.item_id')
						->leftjoin('orders','orders.id','=','order_details.order_id')
						->leftjoin('customers','customers.id','=','orders.customer_id')
						->leftjoin('customer_addresses','customer_addresses.id','=','customers.id')
						->get();
	}
}
