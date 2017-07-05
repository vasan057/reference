<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;
class Order extends Model
{
	protected $table 	=	"orders";

    public static function storeOrder($insertGetId)
	{
		$insertid 	=	DB::table('orders')->insertGetId($insertGetId);
		return $insertid;
	}

	public static function getCustomerOrderHistory($customer_id,$orderstatusid)
	{
		return Order::where('orders.status','1')
							->where('order_details.status','1')
							->where('orders.customer_id',$customer_id)
							->where('orders.order_status_id',$orderstatusid)
							->select('order_date','orders.id','customer_name','order_type_name','order_status_desc','customer_addresses.address_type_id','profile_image','customer_addresses.customer_id','customer_addresses.address',DB::raw('SUM(amount) as totalamount'),'order_status_desc')
							->leftjoin('order_types','order_types.id','=','orders.order_type_id')
							->leftjoin('restaurants','restaurants.id','=','orders.restaurant_id')
							->leftjoin('customers','customers.id','=','orders.customer_id')
							->leftjoin('order_status','order_status.id','=','orders.order_status_id')
							->leftjoin('customer_addresses','customer_addresses.id','=','orders.customer_address_id')
							->leftjoin('order_details','order_details.order_id','=','orders.id')
							->leftjoin('menu_items','menu_items.id','=','order_details.item_id')
							->groupBy('orders.id')
							->get();
	}

	public static function getCustomerPresentOrderdetails($customer_id,$orderstatusid)
	{
		return Order::where('orders.status','1')
							->where('order_details.status','1')
							->where('orders.customer_id',$customer_id)
							->where('orders.order_status_id','<>',$orderstatusid)
							->select('order_date','orders.id','restaurant_name','customer_name','order_type_name','item_price','item_quanitity','amount',DB::raw('SUM(item_quanitity) as totalItems'),'orders.customer_id','order_status_desc')
							->leftjoin('order_types','order_types.id','=','orders.order_type_id')
							->leftjoin('restaurants','restaurants.id','=','orders.restaurant_id')
							->leftjoin('customers','customers.id','=','orders.customer_id')
							->leftjoin('order_status','order_status.id','=','orders.order_status_id')
							->leftjoin('customer_addresses','customer_addresses.id','=','orders.customer_address_id')
							->leftjoin('order_details','order_details.order_id','=','orders.id')
							->leftjoin('menu_items','menu_items.id','=','order_details.item_id')
							->groupBy('orders.id')
							->get();
	}

	public static function getFullOrderDeatils()
	{
		return Order::where('orders.status','1')
				->orwhere('order_details.status','1')
				->select('order_date','orders.id','restaurant_name','customer_name','order_type_name','item_price','item_quanitity','amount',DB::raw('SUM(item_quanitity) as totalItems'),DB::raw('SUM(item_quanitity*amount) as totalPrice'),'order_status.order_status_desc as ordstatus','customers.id as customer_id','order_status.id as ordrstatusid')
				->leftjoin('order_types','order_types.id','=','orders.order_type_id')
				->leftjoin('restaurants','restaurants.id','=','orders.restaurant_id')
				->leftjoin('customers','customers.id','=','orders.customer_id')
				->leftjoin('order_status','order_status.id','=','orders.order_status_id')
				->leftjoin('order_details','order_details.order_id','=','orders.id')
				->leftjoin('menu_items','menu_items.id','=','order_details.item_id')
				->groupBy('orders.id')
				->get();
	}

	public static function getOrderStatusAjax($orderId="")
	{
		return Order::where('orders.id',$orderId)
						->select('orders.id','orders.order_status_id','estimated_time','users_id')
						->leftjoin('bills','bills.order_id','=','orders.id')
						->leftjoin('delivery_tracks','delivery_tracks.bill_id','=','bills.id')
						->get();
	}
}