<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use App\User;
use App\Model\restaurant;
use App\Model\bill;
use App\Model\employee;
use App\Model\restaurant_menu;
use App\Model\Order;
use App\Model\Order_details;

class BillingController extends Controller
{
	public function manageBilling(Request $request,$status = "",$billId="")
	{
		$orderDets 	= Order::where('status','1')->get();
		$restaurant = restaurant::where('status','1')->get();
		if(Input::has('btn_saveBill'))
		{
			$bill 				 = new bill();
			$bill->order_id 	 = $request->get('ddl_orderId');
			$bill->bill_date 	 = $request->get('txt_billdate');
			$bill->amount 		 = $request->get('txt_amount');
			$bill->discount		 = $request->get('txt_discount');
			$bill->restaurant_id = $request->get('ddl_restaurant');
			$bill->status 		 = "1";
			$bill->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateBill'))
			{
				$bill 				 = bill::find($request->get('txt_id'));
				$bill->order_id 	 = $request->get('ddl_orderId');
				$bill->bill_date 	 = $request->get('txt_billdate');
				$bill->amount 		 = $request->get('txt_amount');
				$bill->discount		 = $request->get('txt_discount');
				$bill->restaurant_id = $request->get('ddl_restaurant');
				$bill->status 		 = "1";
				$bill->save();
				return redirect()->action('BillingController@manageBilling');
			}
			else
			{
				$billId 	= decrypt($billId);
				$bill 		= bill::find($billId);
				//dd('a');
				return view('admin/editBilling',compact('bill','orderDets','restaurant'));
			}
		}
		elseif($status == "delete")
		{
			$bill 				 = bill::find($request->get('txt_billId'));
			$bill->status 		 = "0";
			$bill->save();
			return redirect()->back();
		}
		else
		{
			$billing 	= bill::getBillingDetails();
			return view('admin/manageBilling',compact('billing','orderDets','restaurant'));
		}
	}

	public function getOrderDetsAjax(Request $request)
	{
		$Order = Order_details::select(DB::raw('SUM(amount*item_quanitity) as totalAmount'),'restaurant_id')
							->where('order_id',$request->orderId)
							->leftjoin('orders','orders.id','=','order_details.order_id')
							->get();
						//dd($Order);
		return response()->json($Order);
	}
}