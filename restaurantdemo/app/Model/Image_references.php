<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Image_references extends Model
{
	protected $table = "image_references";
    public function Banners()
    {
      	return $this->belongsTo('App\Model\Banners','id');
    }
}
