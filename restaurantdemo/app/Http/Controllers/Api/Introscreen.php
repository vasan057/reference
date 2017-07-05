<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Model\Banners;
class Introscreen extends Controller
{
	//ADD CART ITEMS
	public function index()
	{
		$introbannerimages 		=	Banners::getIntroBannerDetails();
		return response()->json([
								'result'=>1,
								'message'=>'Success',
								'introbannerimages'=>$introbannerimages
							]);		
	}
}