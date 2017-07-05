<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\coupon;

class CouponController extends Controller
{
	public function manageCoupon(Request $request,$status = "",$couponId="")
	{
		if(Input::has('btn_saveCoupon'))
		{
			//dd($request->get('txtar_coupondes'));
			$coupon 							= new coupon();
			$coupon->coupon_code 				= $request->get('txt_couponcode');
			$coupon->coupon_validity  			= $request->get('ddl_couponvalidity');
			$coupon->coupon_start_date			= $request->get('txt_coupon_start_date');
			$coupon->coupon_end_date 			= $request->get('txt_coupon_end_date');
			$coupon->coupon_amount 				= $request->get('txt_couponamt');
			//$coupon->coupon_times_used 			= $request->get('txt_phone');
			$coupon->coupon_max_usage 			= $request->get('txt_couponmxusg');
			$coupon->coupon_min_order_amount 	= $request->get('txt_couponmnordamnt');
			//$coupon->coupon_allowed_percent 	= $request->get('txt_phone');
			$coupon->coupon_descr 				= $request->get('txtar_coupondes');
			$coupon->coupon_visibility 			= $request->get('ddl_couponvisibility');
			$coupon->status 					= "1";
			$coupon->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateCoupon'))
			{
				//dd($couponId);
				$coupon 							= coupon::where('coupon_id',$couponId)
								->update([
						'coupon_code' 				=> $request->get('txt_couponcode'),
						'coupon_validity' 			=> $request->get('ddl_couponvalidity'),
						'coupon_start_date' 		=> $request->get('txt_coupon_start_date'),
						'coupon_end_date'			=> $request->get('txt_coupon_end_date'),
						'coupon_amount'				=> $request->get('txt_couponamt'),
						'coupon_max_usage'  		=> $request->get('txt_couponmxusg'),
						'coupon_min_order_amount' 	=> $request->get('txt_couponmnordamnt'),
						'coupon_descr'				=> $request->get('txtar_coupondes'),
						'coupon_visibility' 		=> $request->get('ddl_couponvisibility'),
						'status' 					=> '1',
										]);
				// $coupon->coupon_code 				= $request->get('txt_couponcode');
				// $coupon->coupon_validity  			= $request->get('ddl_couponvalidity');
				// $coupon->coupon_start_date			= $request->get('txt_coupon_start_date');
				// $coupon->coupon_end_date 			= $request->get('txt_coupon_end_date');
				// $coupon->coupon_amount 				= $request->get('txt_couponamt');
				// //$coupon->coupon_times_used 		= $request->get('txt_phone');
				// $coupon->coupon_max_usage 			= $request->get('txt_couponmxusg');
				// $coupon->coupon_min_order_amount 	= $request->get('txt_couponmnordamnt');
				// //$coupon->coupon_allowed_percent 	= $request->get('txt_phone');
				// $coupon->coupon_descr 				= $request->get('txtar_coupondes');
				// $coupon->coupon_visibility 			= $request->get('ddl_couponvisibility');
				// $coupon->status 					= "1";
				// $coupon->save();
				return redirect()->action('CouponController@manageCoupon');
			}
			else
			{
				$couponId 					= Crypt::decrypt($couponId);
				//dd($couponId);
				$coupon 					= coupon::where('coupon_id',$couponId)->get();
				//dd($coupon);
				return view('admin/editCoupons',compact('coupon'));
			}
		}
		elseif($status == "delete")
		{
			$coupon 						= coupon::where('coupon_id',$request->get('txt_couponId'))
								->update([
						'status' 					=> '0',
										]);
			return redirect()->back();
		}
		else
		{
			$coupon = coupon::where('status','1')->get();
			//dd($coupon);
			return view('admin/manageCoupon',compact('coupon'));
		}
	}
}