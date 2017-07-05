<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class menu_items extends Model
{
	protected $table = 'menu_items';

	public function Image_references()
	{
	  	return $this->belongsTo('App\Model\Image_references','id');
	}

	public static function getFullMenuDetails()
	{
		return menu_items::where('menu_items.status','1')
						->select('menu_items.id','item_name','item_description','item_price','item_type','is_gluten_free','is_lactose_free','allergen_info','image_url')
						->join('image_references','image_references.id','=','menu_items.image_id')
						->get();
	}
}