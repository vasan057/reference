<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
	protected $table ="employees";

	protected $filltable = [
		"position_title","status",
	];

	public function position()
	{
		return $this->hasOne('App\Model\position','id');
	}

    public static function getFullEmployee()
    {
		return employee::where('employees.status','1')
						->select('employees.id as empId','employee_name','employees.address','phone','position_title','restaurant_name','city_name')
						->leftjoin('positions','positions.id','=','employees.position_id')
						->leftjoin('restaurants','restaurants.id','=','employees.restaurant_id')
						->leftjoin('master_cities','master_cities.id','=','employees.city_id')
						->get();
    }
}