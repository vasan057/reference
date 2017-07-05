<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\restaurant;
use App\Model\cart;
use App\Model\customer;
use App\Model\restaurant_menu;
use App\Model\Carts_details;
use App\Model\menu_items;

class CartsController extends Controller
{
	public function manageCarts(Request $request,$status="",$cartId="")
	{
		$customer = customer::wherestatus('1')->get();
		if(Input::has('btn_saveCart'))
		{
			$cart 				= new cart();
			$cart->cart_name 	= $request->get('txt_cartname');
			$cart->customers_id = $request->get('ddl_customer');
			$cart->status 		="1";
			$cart->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_update'))
			{
				$cart 				= cart::find($request->get('txt_id'));
				$cart->cart_name 	= $request->get('txt_cartname');
				$cart->customers_id = $request->get('ddl_customer');
				$cart->status 		="1";
				$cart->save();
				return redirect()->action('CartsController@manageCarts');
			}
			else
			{
				$cartId 			= decrypt($cartId);
				$cart 				= cart::find($cartId);
				return view('admin/editmanageCarts',compact('cart','customer'));
			}
		}
		elseif($status == "delete")
		{
			$cart 			= cart::find($request->get('txt_cartsId'));
			$cart->status 	= "0";
			$cart->save();
			return redirect()->back();
		}
		else
		{
			$cart = cart::getCartDeatils();
			return view('admin/manageCarts',compact('cart','customer'));
		}
	}

	public function manageCartsdetails(Request $request,$status="",$cartDetsId="")
	{
		$cart 		= cart::wherestatus('1')->get();
		$items 		= menu_items::wherestatus('1')->get();
		$customer 	= customer::wherestatus('1')->get();
		if(Input::has('btn_save')&& $status ="add")
		{
			$cartDets 				= new Carts_details();
			$cartDets->item_id 		= $request->get('ddl_items');
			$cartDets->quanitity 	= $request->get('txt_quantity');
			$cartDets->customers_id = $request->get('ddl_customer');
			$cartDets->amount 		= $request->get('txt_amount');
			$cartDets->status 		="1";
			$cartDets->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateCartDetails'))
			{
				$cartDets 				= Carts_details::find($request->get('txt_id'));
				$cartDets->item_id 		= $request->get('ddl_items');
				$cartDets->quanitity 	= $request->get('txt_quantity');
				$cartDets->customers_id = $request->get('ddl_customer');
				$cartDets->amount 		= $request->get('txt_amount');
				$cartDets->status 		="1";
				$cartDets->save();
				return redirect()->action('CartsController@manageCartsdetails');
			}
			else
			{
				$cartDetsId 			= decrypt($cartDetsId);
				$cartDets 				= Carts_details::find($cartDetsId);
				//dd($cartDets);
				return view('admin/editmanageCartsDetails',compact('cartDets','cart','items','customer'));
			}
		}
		elseif($status == "delete")
		{
			$cartDets 				= Carts_details::find($request->get('txt_cartDetailsId'));
			$cartDets->status 		="0";
			$cartDets->save();
			return redirect()->back();
		}
		else
		{
			$cart_deatils = Carts_details::getFullCartDeatilsCart();
			//dd($cart_deatils);
			return view('admin/manageCartsDetails',compact('cart_deatils','cart','items','customer'));
		}
	}

	public function getItemsAjax(Request $request)
	{
		$cart_deatils = menu_items::where('id',$request->itemId)
							->get();
		return response()->json($cart_deatils);
	}
}