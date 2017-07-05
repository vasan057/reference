<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Master_states extends Model
{
    protected $table = "master_states";

    public static function getCity()
    {
    	return  Master_states::where('master_states.status','Active')
							->select('master_states.id as stateId','master_states.state_name as stateName','master_states.created_at','master_countries.id as countryId','master_countries.country_name as countryName')
							->join('master_countries','master_countries.id','=','master_states.country_id')
							->get();
    }
}
