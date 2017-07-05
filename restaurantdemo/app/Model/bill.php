<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class bill extends Model
{
	protected $table = "bills";

	public static function getBillingDetails()
	{
		return bill::where('bills.status','1')
						->select('bills.id','restaurant_name','bill_date','amount','discount','order_id')
						->join('restaurants','restaurants.id','=','bills.restaurant_id')
						->orderBy('bills.id','ASC')
						->get();
	}
}