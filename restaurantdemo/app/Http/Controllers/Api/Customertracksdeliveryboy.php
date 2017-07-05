<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\delivery_track;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Customertracksdeliveryboy extends Controller
{
    public function Customertracksapi(Request $request)
    {
        if(input::get('customer_id') == "" || input::get('order_id') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $datainput          =   $request->all();
        //AUTHENTICATE FOR CUSTOMER
        $customerauth       =   app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($datainput['customer_id']);
        if($customerauth    ==  "Success")
        {
            $getlatitute    =   delivery_track::getCustomerDeliveryTracks(
                                                    $datainput['customer_id'],
                                                    $datainput['order_id']
                                                    );
                return response()->json(['Result'=>config::get("common.onstatus"),
                                        'message'=>'success',
                                        'trackinfo'=>$getlatitute
                                        ]);
        }
        return response()->json([
                                'result'=>config::get("common.offstatus"),
                                'message'=>'Invalid Access!!'
                            ]);
    }
}