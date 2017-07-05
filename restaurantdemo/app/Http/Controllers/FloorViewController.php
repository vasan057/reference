<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\dining_table;

class FloorViewController extends Controller
{
	public function manageFloorView(Request $request,$status="")
	{
		if($status == "edit")
		{
			return view('admin/editFloorView');
		}
		else
		{
			$diningtable 			= dining_table::getDinningTableDetails();
			return view('admin/manageFloorView',compact('diningtable'));
		}
	}
}
