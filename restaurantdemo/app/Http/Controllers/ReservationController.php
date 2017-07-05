<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Model\restaurant;
use App\Model\customer;
use App\Model\dining_table;
use App\Model\reservation;

class ReservationController extends Controller
{
	public function manageReservation(Request $request,$status="",$reservationId="")
	{
		$customer 		= customer::where('status','1')->get();
		$dinningTable 	= dining_table::wherestatus('1')->get();
		if(Input::has('btn_saveReservation'))
		{
			$reservation 					= new reservation();
			$reservation->reservation_date	= $request->get('txt_reservationdate');
			$reservation->customer_id 		= $request->get('ddl_customer');
			$reservation->dining_table_id 	= $request->get('ddl_dinningTable');
			$reservation->status 			="1";
			$reservation->save();
			return redirect()->back();
		}
		elseif($status == "edit")
		{
			if(Input::has('btn_updateReservation'))
			{
				$reservation					= reservation::find($request->get('txt_id'));
				$reservation->reservation_date	= $request->get('txt_reservationdate');
				$reservation->customer_id 		= $request->get('ddl_customer');
				$reservation->dining_table_id 	= $request->get('ddl_dinningTable');
				$reservation->status 			="1";
				$reservation->save();
				return redirect()->action('ReservationController@manageReservation');
			}
			else
			{
				$reservationId 			= decrypt($reservationId);
				$reservation			= reservation::find($reservationId);
				return view('admin/editmanageReservation',compact('reservation','customer','dinningTable'));
			}
		}
		elseif ($status == "delete") 
		{
			$reservation					= reservation::find($request->get('txt_reservationId'));
			$reservation->status 			="0";
			$reservation->save();
			return redirect()->back();
		}
		else
		{
			$reservation = reservation::getManageReservations();
			return view('admin/manageReservation',compact('reservation','customer','dinningTable'));
		}
	}
}