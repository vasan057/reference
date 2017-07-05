<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\restaurant;
use App\Model\dining_table;
use App\Model\dining_table_status;
use App\Model\restaurant_menu;
use App\Model\section;
use App\Model\dining_table_track;
use App\Model\Order;
use App\Model\Order_status;

class DiningtableController extends Controller
{
	public function manageDiningTable(Request $request,$status="",$dinningId="")
	{
		$restaurant 	= restaurant::where('status','1')->get();
		$section	 	= section::wherestatus('1')->get();
		$dinngStatus 	= dining_table_status::all();
		if(Input::has('btn_saveDinningTable'))
		{
			$dinning 				= new dining_table();
			$dinning->table_name 	= $request->get('txt_tableName');
			$dinning->chairs_count 	= $request->get('txt_chairCount');
			$dinning->section_id 	= $request->get('ddl_section');
			$dinning->status_id 	= $request->get('ddl_dinningStatus');
			$dinning->restaurant_id = $request->get('ddl_restaurant');
			$dinning->status 		="1";
			$dinning->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateDinningTable'))
			{
				$dinning 				= dining_table::find($request->get('txt_id'));
				$dinning->table_name 	= $request->get('txt_tableName');
				$dinning->chairs_count 	= $request->get('txt_chairCount');
				$dinning->section_id 	= $request->get('ddl_section');
				$dinning->status_id 	= $request->get('ddl_dinningStatus');
				$dinning->restaurant_id = $request->get('ddl_restaurant');
				$dinning->status 		="1";
				$dinning->save();
				return redirect()->action('DiningtableController@manageDiningTable');
			}
			else
			{
				$dinningId 			= decrypt($dinningId);
				$dinning 			= dining_table::find($dinningId);
				return view('admin/editDiningTable',compact('dinning','restaurant','section','dinngStatus'));
			}
		}
		elseif($status == "delete")
		{
			$dinning 			= dining_table::find($request->get('txt_dinningTableId'));
			$dinning->status 	= "0";
			$dinning->save();
			return redirect()->back();
		}
		else
		{
			$diningtable 			= dining_table::getDinningTableDetails();
			return view('admin/manageDiningTable',compact('diningtable','restaurant','section','dinngStatus'));
		}
	}

	public function manageDiningTableTracks(Request $request,$status="",$dinningTableTrackId="")
	{
		$dining_table 	= dining_table::wherestatus('1')->get();
		$order 			= Order::wherestatus('1')->get();
		$orderStatus 	= Order_status::wherestatus('1')->get();

		if(Input::has('btn_saveDinningTrack'))
		{
			$dinningTrack 					= new dining_table_track();
			$dinningTrack->dining_table_id 	= $request->get('ddl_DinningTable');
			$dinningTrack->order_id 		= $request->get('ddl_order');
			$dinningTrack->order_status_id 	= $request->get('ddl_OrderStatus');
			$dinningTrack->status 			="1";
			$dinningTrack->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateDinningTrack'))
			{
				$dinningTrack 					= dining_table_track::find($request->get('txt_id'));
				$dinningTrack->dining_table_id 	= $request->get('ddl_DinningTable');
				$dinningTrack->order_id 		= $request->get('ddl_order');
				$dinningTrack->order_status_id 	= $request->get('ddl_OrderStatus');
				$dinningTrack->status 			="1";
				$dinningTrack->save();
				return redirect()->action('DiningtableController@manageDiningTableTracks');
			}
			else
			{
				$dinningTableTrackId 			= decrypt($dinningTableTrackId);
				$dinningTableTrack 				= dining_table_track::find($dinningTableTrackId);
				return view('admin/editmanageDiningTracks',compact('dinningTableTrack','dining_table','order','orderStatus'));
			}
		}
		elseif($status == "delete")
		{
			$dinningTrack = dining_table_track::find($request->get('txt_deliveryTrackId'));
			$dinningTrack->status = '0';
			$dinningTrack->save();
			return redirect()->back();
		}
		else
		{
			$dining_tableTracks = dining_table_track::getDinningTableTracks();
			//dd($dining_tableTracks);
			return view('admin/manageDiningTableTracks',compact('dining_tableTracks','dining_table','order','orderStatus'));
		}
	}

	public function manageDinningTableStatus(Request $request,$status="",$tableStatusId="")
	{
		if(Input::has('btn_saveDinningTableStatus'))
		{
			$dinningStatus 			= new dining_table_status();
			$dinningStatus->status 	= $request->get('txt_diningstatus');
			$dinningStatus->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateDinningTableStatus'))
			{
				$dinningStatus 			= dining_table_status::find($request->get('txt_id'));
				$dinningStatus->status 	= $request->get('txt_diningstatus');
				$dinningStatus->save();
				return redirect()->action('DiningtableController@manageDinningTableStatus');
			}
			else
			{
				$tableStatusId 			= decrypt($tableStatusId);
				$dinningStatus 			= dining_table_status::find($tableStatusId);
				return view('admin/editDiningTableStatus',compact('dinningStatus'));
			}
		}
		else
		{
			$dinningTableStatus = dining_table_status::all();
			return view('admin/manageDinningTableStatus',compact('dinningTableStatus'));
		}
	}
}