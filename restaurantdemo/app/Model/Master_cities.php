<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Master_cities extends Model
{
	protected $table = "master_cities";

	public static function getState()
	{
		return Master_cities::where('master_cities.status','1')
					->select('master_cities.id as cityId','state_name','city_name','popular_status','master_cities.status','master_cities.created_at')
					->join('master_states','master_cities.state_id','=','master_states.id')
					->get();
	}

	public static function getStateCountry($cityId)
	{
		return Master_cities::where('master_cities.status','1')
					->select('master_cities.id as cityId','state_name','city_name','popular_status','master_cities.status','master_cities.created_at','master_countries.id as countryId','master_states.id as stateId')
					->join('master_states','master_cities.state_id','=','master_states.id')
					->join('master_countries','master_states.country_id','=','master_countries.id')
					->get();
	}
}