<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use DB;

class Order_type extends Model
{
	protected $table ="order_types";

	public static function storeOrdertype($insertdata)
	{
		$insertid 	=	DB::table('order_types')->insertGetId($insertdata);
		return $insertid;
	}
}