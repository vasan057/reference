<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
	protected $table = "reservations";

	public static function getManageReservations()
	{
		return reservation::where('reservations.status','1')
						->select('reservation_date','reservations.id','chairs_count','customer_name')
						->leftjoin('customers','customers.id','=','reservations.customer_id')
						->leftjoin('dining_tables','dining_tables.id','=','reservations.dining_table_id')
						->get();
	}

	public static function getReservationStatusCustomer($customerId)
	{
		return reservation::where('reservations.status','1')
						->where('reservations.customer_id',$customerId)
						->select('reservation_date','chairs_count')
						->leftjoin('dining_tables','dining_tables.id','=','reservations.dining_table_id')
						->get();
	}
}