<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class position extends Model
{
	protected $table ="positions";
    protected $filltable = [
    	"employee_name","address","phone","position_id","status",
    ];

    public function employee()
    {
    	return $this->belongsTo('App\Model\employee','position_id');
    }
}
