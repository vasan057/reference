<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
	protected $table = "carts";

	public static function getCartDeatils()
	{
		return cart::where('carts.status','1')
				->select('customer_name','carts.id','cart_name')
				->leftjoin('customers','customers.id','=','carts.customers_id')
				->get();
	}
}