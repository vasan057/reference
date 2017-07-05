<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
use File;
use Config;
use App\Model\restaurant;
use App\Model\position;
use App\Model\menu_items;
use App\Model\Banners;

class BannerController extends Controller
{
	public function manageBanner(Request $request,$status = "",$bannerId="")
	{
		$menu_items = menu_items::where('status','1')->get();
		if(Input::has('btn_saveBanner'))
		{
			$banner 					= new Banners();
			$banner->menu_item_id 		= $request->get('ddl_menuitem');
			$banner->banner_name 		= $request->get('txt_bannerName');
			$banner->banner_desc 		= $request->get('txtar_bannerdescription');
			$banner->display_order 		= $request->get('txt_displayorder');
			$banner->status 			= config::get("common.onstatus");
			$banner->banner_type 		= $request->get('ddl_bannerType');

			if(Input::hasFile('fl_bannerimage'))
			{
				$destinationPath 	= public_path().'/assets/img/banner/';
				$file 				= Input::file('fl_bannerimage');
				// dd($path);
				$file_name 			= "banner_" . time() . ".".$file->getClientOriginalExtension();
				$ext 				= $file->getClientOriginalExtension();

				if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
				{
					$file->move($destinationPath, $file_name);
					DB::table('image_references')->insert([
							'image_url' => url("/assets/img/banner/".$file_name),
							'image_desc'=> $request->get('txt_bannerName'),
							'status' 	=> config::get("common.onstatus")
						]);
					$banner->image_id = DB::getPdo()->lastInsertId();
				}
			}
			else
			{
				DB::table('image_references')->insert([
							'image_url' => config::get("common.noimageadmin"),
							'image_desc'=> $request->get('txt_bannerName'),
							'status' 	=> config::get("common.onstatus")
						]);
				$banner->image_id = DB::getPdo()->lastInsertId();
			}
			$banner->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateBanner'))
			{
				$banner 					= Banners::find($request->get('txt_id'));
				$banner->menu_item_id 		= $request->get('ddl_menuitem');
				$banner->banner_name 		= $request->get('txt_bannerName');
				$banner->banner_desc 		= $request->get('txtar_bannerdescription');
				$banner->display_order 		= $request->get('txt_displayorder');
				$banner->status 			= config::get("common.onstatus");
				$banner->banner_type 		= $request->get('ddl_bannerType');

				if(Input::hasFile('fl_bannerpic'))
				{
					//dd('1');
					$destinationPath 	= public_path().'/assets/img/banner/';
					$file 				= Input::file('fl_bannerpic');
					$file_name 			= "banner_".time().".".$file->getClientOriginalExtension();
					$ext 				= $file->getClientOriginalExtension();

					$oldImage 			= DB::table('image_references')
												->find($banner->image_id);
												//dd($oldImage->image_url);

					if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
					{
						$file->move($destinationPath, $file_name);
						File::delete(public_path($oldImage->image_url));
						DB::table('image_references')
									->where('id',$banner->image_id)
									->update([
										'image_url' => url("/assets/img/banner/".$file_name),
									]);
						//$menu->image_id = DB::getPdo()->lastInsertId();
					}
				}

				$banner->save();
				return redirect()->action('BannerController@manageBanner');
			}
			else
			{
				$bannerId = decrypt($bannerId);
				$banners  = banners::find($bannerId);
				//dd($menu);
				return view('admin/editBanner',compact('banners','menu_items'));
			}
		}
		elseif($status == "delete")
		{
			$banner 					= Banners::find($request->get('txt_bannerId'));
			$banner->status 			= config::get("common.offstatus");
			$banner->save();
			return redirect()->back();
		}
		else
		{
			$banner 	= banners::getFullBannerDetails();
			//dd($banner);
			return view('admin/manageBanner',compact('banner','menu_items'));
		}
	}
}