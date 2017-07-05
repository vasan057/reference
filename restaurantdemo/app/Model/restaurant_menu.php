<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class restaurant_menu extends Model
{
	protected $table = "restaurant_menus";

	public function restaurant()
	{
	    return $this->belongsToMany('App\Model\restaurant');
	}
}