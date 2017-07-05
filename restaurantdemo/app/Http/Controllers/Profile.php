<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\customer;
use Config;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\changepassword;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
class Profile extends Controller
{
    public function doChangeforgetPassword($id)
    {
        $getid          =   decrypt($id);
        $wherepassword  =   array('id'=>$getid,'status'=>1);
        $getcustomer    =   customer::where($wherepassword)->first();
        $id             =   (!empty($getcustomer)?$getcustomer->id:'0');
        if($id  ==  $getid)
        {
            return view('apiappchangePassword',['custid'=>$getid]);    
        }
        else
        {
            echo "Please try again";
        }
    }

    public function doChangenewforgetPassword(Request $request)
    {
        $messsages  =   array(
                            'newPassword.required'=>'New Password',
                            'confirmPassword.required'=>'Confirm Password'
                            );
        $validationcheck    =   Validator::make($request->all(),[
                'newPassword' => 'required|min:5',
                'confirmPassword' => 'required|min:5|same:newPassword'
        ],$messsages);
        $getid              =   $request->input('customerid');
        $newPassword        =   md5($request->input('newPassword'));
        $confirmPassword    =   md5($request->input('confirmPassword'));
        if ($validationcheck->passes())
        {
            $wherepassword  =   array('id'=>$getid,'status'=>1);
            $getcustomer    =   customer::where($wherepassword)->first();
            if(!empty($getcustomer))
            {
                if($newPassword == $confirmPassword)
                {
                    $getcustomer['password']   =   $confirmPassword;
                    $success    =   $getcustomer->save();
                    if($success >= 1)
                    {
                        return redirect('restro://');
                        // return response()->json(['Result'=>'1',
                        //                         'message'=>'Password Updated successfully!!'
                        //                         ]);
                    }
                    else
                    {
                        return response()->json(['Result'=>'0',
                                                'message'=>'Password Not Updated successfully!!'
                                                ]);
                    }
                }
                else
                {
                    return Redirect::back()
                            ->withErrors($validationcheck)
                            ->withInput(); 
                }
            }
            else
            {
                return Redirect::back()
                        ->withErrors($validationcheck)
                        ->withInput(); 
            }
        }
        return Redirect::back()
                            ->withErrors($validationcheck)
                            ->withInput();
    }
}