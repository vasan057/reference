<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;

class dining_table extends Model
{
	protected $table = "dining_tables";

	public static function getDinningTableDetails()
	{
		return dining_table::where('dining_tables.status','1')
						->select('restaurant_name','dining_table_statuses.status as dinningStatus','section_name','chairs_count','dining_tables.id','table_name')
						->leftjoin('restaurants','restaurants.id','=','dining_tables.restaurant_id')
						->leftjoin('sections','sections.id','=','dining_tables.section_id')
						->leftjoin('dining_table_statuses','dining_table_statuses.id','=','dining_tables.status_id')
						->get();
	}

	public static function storeDiningtable($insertdata)
	{
		$insertid 	=	DB::table('dining_tables')->insertGetId($insertdata);
		return $insertid;
	}
}