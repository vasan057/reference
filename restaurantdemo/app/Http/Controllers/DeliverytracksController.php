<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\restaurant;
use App\Model\position;
use App\Model\customer;
use App\Model\restaurant_menu;
use App\Model\delivery_track;
use App\Model\bill;
use App\Model\Order_status;

class DeliverytracksController extends Controller
{
	public function manageDelivery(Request $request,$status="",$deliveryId="")
	{
		$customer 		= customer::where('status','1')->get();
		$orderStatus 	= Order_status::wherestatus('1')->get();
		if(Input::has('btn_saveDeliveryTracks'))
		{
			$delivery 						= new delivery_track();
			$delivery->estimated_time 		= $request->get('txt_esttime');
			$delivery->customer_id 			= $request->get('ddl_customer');
			$delivery->bill_id 				= $request->get('ddl_billId');
			$delivery->order_status_id 		= $request->get('ddl_orderStatus');
			$delivery->status 				= "1";
			$delivery->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateDeliveryTracks'))
			{
				$delivery 						= delivery_track::find($request->get('txt_id'));
				$delivery->estimated_time 		= $request->get('txt_esttime');
				$delivery->customer_id 			= $request->get('ddl_customer');
				$delivery->bill_id 				= $request->get('ddl_billId');
				$delivery->order_status_id 		= $request->get('ddl_orderStatus');
				$delivery->status 				= "1";
				$delivery->save();
				return redirect()->action('DeliverytracksController@manageDelivery');
			}
			else
			{
				$deliveryId 	= decrypt($deliveryId);
				$deliveryTracks	= delivery_track::find($deliveryId);
				$bill 			= bill::where('status','1')->get();	
				return view('admin/editmanageDeliveryTracks',compact('deliveryTracks','customer','orderStatus','bill'));
			}
		}
		elseif($status == "delete")
		{
			$delivery 				= delivery_track::find($request->get('txt_deliveryTrackId'));
			$delivery->status 		= "0";
			$delivery->save();
			return redirect()->back();
		}
		else
		{
			$deliveryTracks = delivery_track::getDeliveryTracks();
			return view('admin/manageDeliveryTracks',compact('deliveryTracks','customer','orderStatus'));
		}
	}

	public function getCustomerBillAjax(Request $request)
	{
		$bill = bill::join('orders','orders.id','=','bills.order_id')
					->where('bills.status','1')
					->select('bills.id')
					->where('customer_id',$request->customerId)
					//->leftjoin('customers','customers.id','=orders.customer_id')
					->get();
		return response()->json($bill);
	}
}