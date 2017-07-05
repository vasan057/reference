<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class dining_table_track extends Model
{
	protected $table = "dining_table_tracks";

	public static function getDinningTableTracks()
	{
		return dining_table_track::where('dining_table_tracks.status','1')
				->select('table_name','chairs_count','order_date','order_status_desc','dining_table_tracks.id')
				->leftjoin('dining_tables','dining_tables.id','=','dining_table_tracks.dining_table_id')
				->leftjoin('orders','orders.id','=','dining_table_tracks.order_id')
				->leftjoin('order_status','order_status.id','=','dining_table_tracks.order_status_id')
				->get();
	}
}