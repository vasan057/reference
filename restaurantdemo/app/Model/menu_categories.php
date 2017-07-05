<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class menu_categories extends Model
{

	protected $table="menu_categories";

	public static function getFullMenuCategory()
	{
		return menu_categories::where('menu_categories.status','1')
								->select('menu_categories.id as menuId','category_name','description','image_url')
								->leftjoin('image_references','image_references.id','=','menu_categories.image_id')
								->get();
	}

}