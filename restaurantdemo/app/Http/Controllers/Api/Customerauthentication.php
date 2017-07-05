<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Customerauthentication extends Controller
{
    public function customerAuth($customerid)
    {
        if($customerid ==   "")
        {
            return "Failed";
        }
        $customerlogin      =   customer::where('id',$customerid)->first();
        if(!empty($customerlogin) && count($customerlogin)  >=  1)
        {
            return  "Success";
        }
        else
        {
            return "Failed";
        }
    }
}