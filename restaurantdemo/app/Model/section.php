<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
	protected $table = "sections";

	public static function getFullSections()
	{
		return section::where('sections.status','1')
						->select('section_type','section_property_name','section_name','sections.id','restaurant_name')
						->leftjoin('section_types','section_types.id','=','sections.section_type_id')
						->leftjoin('section_properties','section_properties.id','=','sections.section_property_id')
						->leftjoin('restaurants','restaurants.id','=','sections.restaurant_id')
						->get();
	}
}
