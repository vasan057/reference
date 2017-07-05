<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class Customer_addresses extends Model
{
	protected $table="customer_addresses";

	public static function getCustomerDetails()
	{
		return customer_addresses::where('customer_addresses.status','1')
				->select('customer_addresses.id','customer_name','address','latitude','longitude','city_name','address_type_desc')
				->leftjoin('customers','customers.id','=','customer_addresses.customer_id')
				->leftjoin('address_types','address_types.id','=','customer_addresses.address_type_id')
				->leftjoin('master_cities','master_cities.id','=','customer_addresses.city_id')
				->get();
	}

	public static function getCustomerDetailsSpecific($customerId)
	{
		//dd($customerId);
		return customer_addresses::where('customer_addresses.status','1')
				->where('customer_addresses.customer_id',$customerId)
				->select('customer_addresses.id','customer_name','address','latitude','longitude','city_name','address_type_desc')
				->leftjoin('customers','customers.id','=','customer_addresses.customer_id')
				->leftjoin('address_types','address_types.id','=','customer_addresses.address_type_id')
				->leftjoin('master_cities','master_cities.id','=','customer_addresses.city_id')
				->get();
	}
}
