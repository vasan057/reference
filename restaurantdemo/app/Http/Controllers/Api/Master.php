<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use DB;
use App\Model\Master_cities;
use App\Model\Master_states;
use App\Model\Master_countries;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Master extends Controller
{
	public function getCountry()
	{
		$Countrynames  =   Master_countries::where('status','1')->get();
		return response()->json([
									'MasterCountry'=>$Countrynames
								]);	
	}
	public function getcity()
	{
		$state_id 		=	input::get('state_id');
		if($state_id 	==	"")
		{
			return response()->json([
									'result'=>0,
									'message'=>'State id is required!!'
								]);	
		}
		$wherecity 	=	array('status'=>'1','state_id'=>$state_id);
		$citynames  =   Master_cities::where($wherecity)->orderBy('popular_status','DESC')->get();
		return response()->json([
									'Master_City'=>$citynames
								]);	
	}
	public function getState()
	{
		$statenames =   Master_states::where('status','1')->get();
		return response()->json([
									'Master_State'=>$statenames
								]);	
	}
}