<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\restaurant;
use App\Model\Image_references;
use App\Model\employee;
use App\Model\restaurant_menu;

class ImagereferenceController extends Controller
{
	public function manageImagereference(Request $request,$status="",$menuId="")
	{
		if(Input::has('btn_saveImageRef'))
		{
			if(Input::hasFile('fl_manageImage'))
			{
				$destinationPath 	= public_path().'assets/img/common/';
				$file 				= Input::file('fl_manageImage');
				$file_name 			= "common_" . time() . ".".$file->getClientOriginalExtension();
				$ext 				= $file->getClientOriginalExtension();

				if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
				{
					$file->move($destinationPath, $file_name);
					$imgRef 			= new Image_references();
					$imgRef->image_url  = url("/assets/img/common/".$file_name);
					$imgRef->image_desc = $request->get('txt_imgname');
					$imgRef->status 	="1";
					$imgRef->save();
				}
			}
			return redirect()->back();
		}
		elseif($status == "delete")
		{
			$imgRef 			= Image_references::find($request->get('txt_ImageRefId'));
			$imgRef->status 	="0";
			$imgRef->save();
			return redirect()->back();
		}
		else
		{
			$image_reference = Image_references::where('status','1')->get();
			return view('admin/manageImageReference',compact('image_reference'));
		}
	}

	public function doManageImage(Request $request,$status="",$menuId="")
	{
		if(Input::has('btn_save')&& $status ="add")
		{
			$menu 				= new restaurant_menu();
			$menu->menu_version = $request->get('txt_menu');
			$menu->status 		="1";
			$menu->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_update'))
			{
				$menu 				= restaurant_menu::find($request->get('txt_id'));
				$menu->menu_version = $request->get('txt_menuName');
				$menu->status 		="1";
				$menu->save();
				return redirect()->action('ManageImagerefernce@doManageImage');
			}
			else
			{
				$menuId 			= decrypt($menuId);
				$menu 				= restaurant_menu::find($menuId);
				return view('admin/manageImagerefernce',compact('menu'));
			}
		}
		else
		{
			$rest_menu = restaurant_menu::where('status','1')->get();
			return view('admin/manageImagerefernce',compact('rest_menu'));
		}
	}
}