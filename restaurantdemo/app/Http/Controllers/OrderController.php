<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Config;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\restaurant;
use App\Model\position;
use App\Model\employee;
use App\Model\restaurant_menu;
use App\Model\menu_items;
use App\Model\Master_cities;
use App\Model\menu_categories;
use App\Model\Order_type;
use App\Model\Order;
use App\Model\customer;
use App\Model\Order_status;
use App\Model\Order_details;
use App\Model\Restaurant_menu_items;
use App\Model\Customer_addresses;
use App\Model\Image_references;
use App\Model\orders_history;
use App\Model\dining_table_track;
use App\Model\bill;

class OrderController extends Controller
{
	public function manageOrdersDetails(Request $request,$status = "",$restaurantId="")
	{
		if(Input::has('btn_SaveOrder'))
		{
			$order_dets					= new Order_details();
			$order_dets->item_id 		= $request->get('ddl_items');
			$order_dets->item_quanitity = $request->get('txt_itemQuantity');
			$order_dets->amount 		= $request->get('txt_amount');
			$order_dets->order_id 		= $request->get('txt_orderId');
			$order_dets->status 		= "1";
			$order_dets->save();
			return redirect()->back();
		}
		elseif($status == "delete")
		{
			$order_dets 			= Order_details::find($request->get('txt_OrderItemId'));
			$order_dets->status 	= "0";
			$order_dets->save();
			return redirect()->back();
		}
		else
		{
			$restaurant = restaurant::all();
			return view('admin/manageOrderDetails',compact('restaurant'));
		}
	}

	public function manageOrderStatus(Request $request,$status = "",$orderStatusId="")
	{
		if(Input::has('btn_saveOrderStatus'))
		{
			$order 						= new Order_status();
			$order->order_status_desc 	= $request->get('txt_orderstatus');
			$order->status 				= "1";
			$order->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateOrderStatus'))
			{
				$order 						= Order_status::find($request->get('txt_id'));
				$order->order_status_desc 	= $request->get('txt_orderstatus');
				$order->status 				= "1";
				$order->save();
				return redirect()->action('OrderController@manageOrderStatus');
			}
			else
			{
				$orderStatusId 	= decrypt($orderStatusId);
				$orderStatus 	= Order_status::find($orderStatusId);
				return view('admin/editOrderStatus',compact('orderStatus'));
			}
		}
		elseif($status == "delete")
		{
			$order 						= Order_status::find($request->get('txt_OrderStatusId'));
			$order->status 				= "0";
			$order->save();
			return redirect()->back();
		}
		else
		{
			$orderStatus = Order_status::wherestatus('1')->get();
			return view('admin/manageOrderStatus',compact('orderStatus'));
		}
	}

	public function manageOrderTypes(Request $request,$status = "",$orderTypeId="")
	{
		if(Input::has('btn_saveOrderType'))
		{
			$order 						= new order_type();
			$order->order_type_name 	= $request->get('txt_addorderType');
			$order->status 				= "1";
			$order->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			//$restaurant 					= restaurant::where('id',$restaurantId)->get();
			if(Input::has('btn_updateOrder'))
			{
				$order 						= order_type::find($request->get('txt_id'));
				$order->order_type_name 	= $request->get('txt_editorderType');
				$order->status 				= "1";
				$order->save();
				return redirect()->action('OrderController@manageOrderTypes');
			}
			else
			{
				$orderTypeId 	= decrypt($orderTypeId);
				$order_type 	= order_type::find($orderTypeId);
				return view('admin/editOrderTypes',compact('order_type'));
			}
		}
		elseif($status == "delete")
		{
			$order 			= order_type::find($request->get('txt_orderTypeId'));
			$order->status 	= "0";
			$order->save();
			return redirect()->back();
		}
		else
		{
			$order_type = order_type::where('status','1')->get();
			return view('admin/manageOrderTypes',compact('order_type'));
		}
	}

	public function manageMapView($value='')
	{
		$customers = customer::where('status','1')->get();
		$restaurant = restaurant::wherestatus('1')->get();
		return view('admin.manageMapView',compact('customers','restaurant'));
	}

	public function manageMenu(Request $request,$status="",$menuId="")
	{
		if(Input::has('btn_save')&& $status ="add")
		{
			$menu 				= new restaurant_menu();
			$menu->menu_version = $request->get('txt_menu');
			$menu->status 		=config::get("common.onstatus");
			$menu->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_update'))
			{
				$menu 				= restaurant_menu::find($request->get('txt_id'));
				$menu->menu_version = $request->get('txt_menuName');
				$menu->status 		=config::get("common.onstatus");
				$menu->save();
				return redirect()->action('adminController@manageMenu');
			}
			else
			{
				$menuId 			= decrypt($menuId);
				$menu 				= restaurant_menu::find($menuId);
				$menu_categories 	= menu_categories::where('status','1')->get();
				$menu_items 		= menu_items::wherestatus('1')->get();
				$rest_menu_item 	= Restaurant_menu_items::getRestaurantMenuItems($menuId);
				return view('admin/editMenu',compact('menu','menu_categories','menu_items','rest_menu_item'));
			}
		}
		elseif($status == "delete")
		{
			$menu 				= restaurant_menu::find($request->get('txt_menuId'));
			$menu->status 		=config::get("common.offstatus");
			$menu->save();
			return redirect()->back();
		}
		else
		{
			$rest_menu = restaurant_menu::where('status',config::get("common.onstatus"))->get();
			return view('admin/manageMenu',compact('rest_menu'));
		}
	}

	public function managerestaurantMenus($status = "",$menuItemId="",Request $request)
	{
		if(Input::has('btn_updateMenuItems'))
		{
			$rest_menu_item 				= new Restaurant_menu_items();
			$rest_menu_item->menu_id 		= $request->get('txt_id');
			$rest_menu_item->category_id	= $request->get('ddl_category');
			$rest_menu_item->item_id 		= $request->get('ddl_Itemdetail');
			$rest_menu_item->display_order 	= $request->get('txt_order');
			$rest_menu_item->status 		= config::get("common.onstatus");
			$rest_menu_item->save();
			return redirect()->back();
		}
		elseif($status == "delete")
		{
			$rest_menu_item 		= Restaurant_menu_items::find($request->get('txt_restMenuId'));
			$rest_menu_item->status = config::get("common.offstatus");
			$rest_menu_item->save();
			return redirect()->back();
		}
	}

	public function manageCategories(Request $request,$status="",$menuId="")
	{
		if(Input::has('btn_addCategory'))
		{
			$menu 					= new menu_categories();
			$menu->category_name 	= $request->get('txt_categorieName');
			$menu->description 		= $request->get('txtar_categorieDescription');
			if(Input::hasFile('fl_categoryImage'))
			{
				$destinationPath 	= public_path().'/assets/img/menu/';
				$file 				= Input::file('fl_categoryImage');
				$file_name 			= "menuCategory_".time().".".$file->getClientOriginalExtension();
				$ext 				= $file->getClientOriginalExtension();

				if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
				{
					$file->move($destinationPath, $file_name);
					DB::table('image_references')->insert([
							'image_url' => url("/assets/img/menu/".$file_name),
							'status' 	=> "1",
							'image_desc'=> $request->get('txt_categorieName')
						]);
					$menu->image_id = DB::getPdo()->lastInsertId();
				}
			}
			else
			{
				DB::table('image_references')->insert([
							'image_url' => "http://www.evinrudenation.com/wp-content/uploads/2012/10/no-image-icon1-200x150.jpg",
							'status' 	=> config::get("common.onstatus"),
							'image_desc'=> $request->get('txt_categorieName')
						]);
				$menu->image_id = DB::getPdo()->lastInsertId();
			}
			$menu->status 			=config::get("common.onstatus");
			$menu->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateCategory'))
			{
				$menu 					= menu_categories::find($request->get('txt_id'));
				$menu->category_name 	= $request->get('txt_categorieName');
				$menu->description 		= $request->get('txtar_categorieDescription');
				if(Input::hasFile('fl_categoryImage'))
				{
					$destinationPath 	= public_path().'/assets/img/menu/';
					$file 				= Input::file('fl_categoryImage');
					$file_name 			= "menuCategory_".time().".".$file->getClientOriginalExtension();
					$ext 				= $file->getClientOriginalExtension();

					$oldImage 			= DB::table('image_references')
												->find($menu->image_id);
												//dd($oldImage->image_url);

					if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
					{
						$file->move($destinationPath, $file_name);
						File::delete(public_path($oldImage->image_url));
						DB::table('image_references')
									->where('id',$menu->image_id)
									->update([
										'image_url' => url("/assets/img/menu/".$file_name),
										'image_desc'=> $request->get('txt_categorieName')
									]);
						//$menu->image_id = DB::getPdo()->lastInsertId();
					}
				}
				$menu->status 			=config::get("common.onstatus");
				$menu->save();
				return redirect()->action('adminController@manageCategories');
			}
			else
			{
				$menuId 			= decrypt($menuId);
				$menu 				= menu_categories::find($menuId);	
				return view('admin/editmanageCategories',compact('menu'));
			}
		}
		elseif($status == "delete")
		{
			$menu 					= menu_categories::find($request->get('txt_menuId'));
			$menu->status 			= config::get("common.offstatus");
			$menu->save();
			return redirect()->back();
		}
		else
		{
			$categories 			= menu_categories::getFullMenuCategory();
			return view('admin/manageCategories',compact('categories'));
		}
	}

	public function manageMenuItems(Request $request,$status="",$menuId="")
	{
		if(Input::has('btn_save')&& $status ="add")
		{
			if($request->get('rb_is_lactose_free') == "1")
			{
				$lactoseFree = "1";
			}
			else
			{
				$lactoseFree = "0";
			}
			if($request->get('rb_is_gluten_free') == "1")
			{
				$glutenFree = "1";
			}
			else
			{
				$glutenFree = "0";
			}
			$menu 						= new menu_items();
			$menu->item_name 			= $request->get('txt_item_name');
			$menu->item_description 	= $request->get('txtar_item_description');
			$menu->item_price 			= $request->get('txt_item_price');
			//$menu->image_id 			= "";
			$menu->item_type 			= $request->get('ddl_menuItemType');
			$menu->is_gluten_free 		= $glutenFree;
			$menu->is_lactose_free 		= $lactoseFree;
			$menu->allergen_info		= $request->get('txtar_allergenInfo');
			$menu->item_notes 			= $request->get('txtar_itemNotes');
			$menu->status 				= config::get("common.onstatus");
			if(Input::hasFile('fl_menuImage'))
			{
				$destinationPath 	= public_path().'/assets/img/menuItems/';
				$file 				= Input::file('fl_menuImage');
				$file_name 			= "menuitems_".time() . ".".$file->getClientOriginalExtension();
				$ext 				= $file->getClientOriginalExtension();

				if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
				{
					$file->move($destinationPath, $file_name);
					DB::table('image_references')->insert([
							'image_url' => url("/assets/img/menuItems/".$file_name),
							'status'	=> config::get("common.onstatus"),
							'image_desc'=> $request->get('txt_item_name')
						]);
					$menu->image_id = DB::getPdo()->lastInsertId();
				}
			}
			else
			{
				DB::table('image_references')->insert([
							'image_url' => "http://www.evinrudenation.com/wp-content/uploads/2012/10/no-image-icon1-200x150.jpg",
							'status'	=> config::get("common.onstatus"),
							'image_desc'=> $request->get('txt_item_name')
						]);
				$menu->image_id = DB::getPdo()->lastInsertId();
			}
			$menu->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_update'))
			{
				if($request->get('rb_is_lactose_free') == "1")
				{//dd('1');
					$lactoseFree = "1";
				}
				else
				{
					//dd('0');
					$lactoseFree = "0";
				}
				if($request->get('rb_is_gluten_free') == "1")
				{
					$glutenFree = "1";
				}
				else
				{
					$glutenFree = "0";
				}
				$menu 						= menu_items::find($request->get('txt_id'));
				$menu->item_name 			= $request->get('txt_item_name');
				$menu->item_description 	= $request->get('txtar_item_description');
				$menu->item_price 			= $request->get('txt_item_price');
				//$menu->image_id 			= "";
				$menu->item_type 			= $request->get('ddl_menuItemType');
				$menu->is_gluten_free 		= $glutenFree;
				$menu->is_lactose_free 		= $lactoseFree;
				$menu->allergen_info		= $request->get('txtar_allergenInfo');
				$menu->item_notes 			= $request->get('txtar_itemNotes');
				$menu->status 				= config::get("common.onstatus");

				if(Input::hasFile('fl_menuImage'))
				{
					$destinationPath 	= public_path().'/assets/img/menuItems/';
					$file 				= Input::file('fl_menuImage');
					$file_name 			= "menuitems_".time().".".$file->getClientOriginalExtension();
					$ext 				= $file->getClientOriginalExtension();

					$oldImage 			= DB::table('image_references')
												->find($menu->image_id);
												//dd($oldImage->image_url);

					if (($ext == 'gif') || ($ext == 'jpg') || ($ext == 'png')|| ($ext == 'jpeg')) 
					{
						$file->move($destinationPath, $file_name);
						File::delete(public_path($oldImage->image_url));
						DB::table('image_references')
									->where('id',$menu->image_id)
									->update([
										'image_url' => url("/assets/img/menuItems/".$file_name),
										'image_desc'=> $request->get('txt_item_name')
									]);
						//$menu->image_id = DB::getPdo()->lastInsertId();
					}
				}
				$menu->save();
				return redirect()->action('adminController@manageMenuItems');
			}
			else
			{
				$menuId 			= decrypt($menuId);
				$menu 				= menu_items::find($menuId);
				//dd($menu);
				return view('admin/editmanageMenuItems',compact('menu'));
			}
		}
		elseif($status == "delete")
		{
			$menu 				= menu_items::find($request->get('txt_menuId'));
			$menu->status 		= config::get("common.offstatus");
			$menu->save();
			return redirect()->back();
		}
		else
		{
			$rest_menu = menu_items::getFullMenuDetails();
			return view('admin/manageMenuItems',compact('rest_menu'));
		}
	}

	public function manageOrders(Request $request,$status="",$orderId="",$customerId="")
	{
		$Order_type 	= Order_type::where('status','1')->get();
		$restaurant 	= restaurant::where('status','1')->get();
		$customer 		= customer::where('status','1')->get();
		$Order_status 	= Order_status::where('status','1')->get();

		if(Input::has('btn_saveOrder'))
		{
			$order 						= new Order();
			$order->order_date 			= $request->get('txt_orddate');
			$order->order_type_id 		= $request->get('ddl_ordertype');
			$order->restaurant_id 		= $request->get('ddl_restname');
			$order->customer_id 		= $request->get('ddl_cusname');
			$order->order_status_id 	= $request->get('ddl_ordestatus');
			$order->customer_address_id = $request->get('ddl_cusaddress');
			//$order->employee_id 		= '';
			$order->status 				= config::get("common.onstatus");
			$order->save();

			$orders_history 					= new orders_history();
			$orders_history->order_date			= date("Y-m-d")	;
			$orders_history->order_id 			= DB::getPdo()->lastInsertId();
			$orders_history->order_status_id 	= config::get("common.onstatus");
			$orders_history->status 			= config::get("common.onstatus");
			$orders_history->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateOrder'))
			{
				$order 						= Order::find($request->get('txt_id'));
				$order->order_date 			= $request->get('txt_orderdate');
				$order->order_type_id 		= $request->get('ddl_ordertype');
				$order->restaurant_id 		= $request->get('ddl_restname');
				$order->customer_id 		= $request->get('ddl_cusname');
				$order->order_status_id 	= $request->get('ddl_ordestatus');
				$order->customer_address_id = $request->get('ddl_cusaddress');
				//$order->customer_address_id = '';
				//$order->employee_id 		= '';
				$order->status 				=config::get("common.onstatus");
				$order->save();

				$orders_history 					= new orders_history();
				$orders_history->order_date			= date("Y-m-d")	;
				$orders_history->order_id 			= $request->get('txt_id');
				$orders_history->order_status_id 	= $request->get('ddl_ordestatus');
				$orders_history->status 			= config::get("common.onstatus");
				$orders_history->save();
				return redirect()->action('adminController@manageOrders');
			}
			else
			{
				$orderId 		 = decrypt($orderId);
				$order 			 = Order::find($orderId);
				$menuItems 		 = menu_items::where('status','1')->get();
				$order_details 	 = order_details::getManageOrder($orderId);
				$customerId 	 = decrypt($customerId);
				$customerAddress = Customer_addresses::where('customer_id',$customerId)->get();
				//dd($customerId);
				return view('admin/editmanageOrders',compact('order','Order_type','restaurant','customer','Order_status','orders','menuItems','order_details','customerAddress'));
			}
		}
		elseif($status == "delete")
		{
			$order 			= Order::find($request->get('txt_OrderId'));
			$order->status 	= config::get("common.offstatus");
			$order->save();

			$orders_history 					= new orders_history();
			$orders_history->order_date			= date("Y-m-d")	;
			$orders_history->order_id 			= $request->get('txt_OrderId');
			$orders_history->order_status_id 	= config::get("common.orderDeleteStatus");
			$orders_history->status 			= config::get("common.onstatus");
			$orders_history->save();
			return redirect()->back();
		}
		else
		{
			$orders 				= Order::getFullOrderDeatils();
			//dd($orders);
			$orderstatus 			= Order_status::wherestatus(config::get("common.onstatus"))
												->get();
			$deiveryBoys 			= User::wherestatus('1')
												->where('user_present_status','1')
												->get();
			//dd($orders);
			return view('admin/manageOrders',compact('Order_type','restaurant','customer','Order_status','orders','orderstatus','deiveryBoys'));
		}
	}

	public function getCustomerAddress(Request $request)
	{
		$custAddr = Customer_addresses::where('customer_id',$request->customerId)->get();
		return response()->json($custAddr);
	}

	public function getMenuItemPrice(Request $request)
	{
		$itemPrice = menu_items::where('id',$request->priceId)->get();
		return response()->json($itemPrice);
	}

	public function getOrderStatus(Request $request)
	{
		if(Input::has('btn_ChangeStatus'))
		{
			$order 						= Order::find($request->get('txt_OrderId'));
			//dd($order);
			$order->order_status_id 	= $request->get('ddl_orderStatus');
			$order->save();

			$orders_history 					= new orders_history();
			$orders_history->order_date			= date("Y-m-d")	;
			$orders_history->order_id 			= $request->get('txt_OrderId');
			$orders_history->order_status_id 	= $request->get('ddl_orderStatus');
			$orders_history->status 			= config::get("common.onstatus");
			$orders_history->save();

			$billId 				= bill::where('order_id',$request->get('txt_OrderId'))
												->get();
			//dd($billId);
			if($request->get('ddl_orderStatus') == '4')
			{
				//dd($billId);
				if(isset($billId))
				{
					//dd('1');
					//dd($billId[0]->id);
					$track 					= new dining_table_track();
					$track->estimated_time	= $request->get('txt_estimatedTime');
					$track->customer_id 	= $order->customer_id;
					$track->bill_id 		= $billId[0]->id;
					$track->order_status_id = $request->get('ddl_orderStatus');
					$track->employees_id 	= $request->get('ddl_deliveryboy');
					$track->status 			= config::get('common.onstatus');
				}
				else
				{
					dd('Bill Not Yet Generate');
					\Session::flash('wrong_message', 'Bill Not Yet Genereate');
				}
			}
			return redirect()->back();
		}
		else
		{
			return Order::getOrderStatusAjax($request->get('id'));
		}
	}
}