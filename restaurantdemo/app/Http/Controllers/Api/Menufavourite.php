<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\customer;
use App\Model\Menu_favourites;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Menufavourite extends Controller
{
	public function index()
	{
		$customer_id  =   input::get('customer_id');
        if($customer_id ==  "")
        {
            return response()->json([
                                    'result'=>0,
                                    'message'=>'Customer id is required'
                                ]); 
        }
        //AUTHENTICATE FOR CUSTOMER
        $customerauth       =   app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);
        if($customerauth    ==  "Success")
        {    
            $getItems    =   Menu_favourites::getFavouritesItems($customer_id);
            return response()->json([
                                    'result'=>1,
                                    'message'=>'success',
                                    'Favouritesitems'=>$getItems
                                ]);     
        }       
        return response()->json([
                                'result'=>0,
                                'message'=>'Invalid Access!!'
                            ]);
	}

	public function store()
    {
    	if(input::get('customer_id') == "" || input::get('menuitem_id') == "" || input::get('favourite_item') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $customer_id        =   input::get('customer_id');
        $menuitem_id        =   input::get('menuitem_id');
        $favourite_item     =   input::get('favourite_item');
        //AUTHENTICATE FOR CUSTOMER
        $customerauth       =   app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);
        if($customerauth    ==  "Success")
        {           
            $where          =   array('customer_id'=>$customer_id,'menu_items_id'=>$menuitem_id);
            $getfavourites  =   Menu_favourites::where($where)->first();
            if(!empty($getfavourites) && count($getfavourites) >= 1)
            {    
                if($favourite_item == 0)
                {
                    $getfavourites['customer_id']   =   $customer_id;
                    $getfavourites['menu_items_id'] =   $menuitem_id;
                    $getfavourites['status'] =   0;
                    $success    =   $getfavourites->save();
                    if($success >= 1)
                    {
                        return response()->json([
                                    'result'=>1,
                                    'message'=>'Successfully Removed Your Favourites items!!'
                                ]);
                    }
                }            
                if($favourite_item == 1)
                {
                    $getfavourites['customer_id']   =   $customer_id;
                    $getfavourites['menu_items_id'] =   $menuitem_id;
                    $getfavourites['status'] =   1;
                    $success    =   $getfavourites->save();
                    if($success >= 1)
                    {
                        return response()->json([
                                    'result'=>1,
                                    'message'=>'Successfully Added Your Favourites items!!'
                                ]);
                    }
                }
                
            }
            else
            {
                $getfavourites      =   new Menu_favourites();
                $getfavourites['customer_id']   =   $customer_id;
                $getfavourites['menu_items_id'] =   $menuitem_id;
                $getfavourites['status'] =   1;
                $success    =   $getfavourites->save();
                if($success >= 1)
                {
                    return response()->json([
                                'result'=>1,
                                'message'=>'Successfully Added Your Favourites items!!'
                            ]);
                }
            }
            return response()->json([
                                    'result'=>0,
                                    'message'=>'Please try again!!'
                                ]);     
        } 
        else
        {
            return response()->json([
                                    'result'=>0,
                                    'message'=>'Invalid Access!!'
                                ]);
        }
    }
}