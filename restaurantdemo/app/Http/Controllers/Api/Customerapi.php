<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\customer;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Customerapi extends Controller
{
	public function index()
	{
		$customers  =   customer::all();
		return response()->json([
									'customer'=>$customers
								]);	
	}

	public function store(Request $request)
    {
    	if(input::get('firstname') == "" || input::get('email') == "" || input::get('phoneno') == "" || input::get('password') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        //CHECK EMAIL ID EXIST AND MOBILE NUMBER
        $customeremailid    =   customer::all()->where('email',input::get('email'))->first();
        $customermobile     =   customer::all()->where('phone',input::get('phoneno'))->first();
        if($customeremailid)
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'Email id is already exist with us please try another email id!!'
                                    ]);
        }
        if($customermobile)
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'This mobile number is already exist with us please try another Mobile number!!'
                                    ]);
        }
    	$cusomer 					=	new customer;
        $cusomer['customer_name'] 	= 	input::get('firstname');
        $cusomer['phone'] 			= 	input::get('phoneno');
        $cusomer['status'] 			= 	1;
        $cusomer['email'] 			= 	input::get('email');
        $cusomer['password'] 		= 	md5(input::get('password'));
        $cusomer['profile_image']   =   url(config::get("common.profilenoimage"));
        $success 	=	$cusomer->save();
        if($success >= 1)
        {
            return response()->json(['Result'=>'1',
                                    'message'=>'Customer is added successfully!!'
                                    ]);
        }
        else
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'Customer is not added successfully!!'
                                    ]);
        }
    }

    public function customerLogin(Request $request)
    {
        if(input::get('email') == "" || input::get('password') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $wherecustomer      =   array('email'=>input::get('email'),'password'=>md5(input::get('password')));
        $customerlogin      =   customer::where($wherecustomer)->first();
        if(!empty($customerlogin) && count($customerlogin)  >=  1)
        {
            return response()->json(['Result'=>'1',
                                    'message'=>'sucess',
                                    'customername'=>$customerlogin->customer_name,
                                    'email'=>$customerlogin->email,
                                    'phone'=>$customerlogin->phone,
                                    'customerid'=>$customerlogin->id,
                                    'profile_image' =>($customerlogin->profile_image == null?url(config::get("common.profilenoimage")):$customerlogin->profile_image)
                                    ]);
        }
        else
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'Invalid Emailid or password Plase try again!!'
                                    ]);
        }
    }
}