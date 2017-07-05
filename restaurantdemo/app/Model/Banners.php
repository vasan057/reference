<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
	protected $table = "banners";
	public function Image_references()
	{
	  	return $this->hasMany('App\Model\Image_references','id');
	}

    public static function getFullBannerDetails()
    {
    	return banners::where('banners.status','1')
    				->select('banners.id as bannerId','banner_name','banner_desc','image_url','display_order','item_name','banner_type')
    				->leftjoin('image_references','image_references.id','=','banners.image_id')
    				->leftjoin('menu_items','menu_items.id','=','banners.menu_item_id')
    				->get();
    }

    public static function getSliderBannerDetails()
    {
        return banners::where('banners.status','1')
                    ->where('banner_type','Slider')
                    ->leftjoin('image_references','image_references.id','=','banners.image_id')
                    ->get();
    }

    public static function getIntroBannerDetails()
    {
        return banners::where('banners.status','1')
                    ->where('banner_type','Intro')
                    ->leftjoin('image_references','image_references.id','=','banners.image_id')
                    ->get();
    }
}