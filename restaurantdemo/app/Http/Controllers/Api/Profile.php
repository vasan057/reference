<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\customer;
use Config;
use Redirect;
use File;
use App\Http\Controllers\Controller;
use App\Http\Requests\changepassword;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
class Profile extends Controller
{
	public function index()
	{
		$customer_id  =   input::get('customer_id');
        if($customer_id ==  "")
        {
            return response()->json([
                                    'result'=>config::get("common.offstatus"),
                                    'message'=>'Customer id is required'
                                ]); 
        }
        //AUTHENTICATE FOR CUSTOMER
        $customerauth       =   app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);
        if($customerauth    ==  "Success")
        {           
            $getcustomer    =   customer::where('id',$customer_id)->get();
            $datacustomer   =   array();
            if(!empty($getcustomer) && count($getcustomer) >= 1)
            {
                foreach($getcustomer as $customer)
                {
                    $data['id']                 =   $customer->id;
                    $data['firstname']          =   $customer->customer_name;
                    $data['phone']              =   $customer->phone;
                    $data['status']             =   $customer->status;
                    $data['email']              =   $customer->email;
                    $data['landline_1']         =   $customer->phone_number_landline_1;
                    $data['landline_2']         =   $customer->phone_number_landline_2;
                    $data['profile_image']      =   ($customer->profile_image == null?url(config::get("common.profilenoimage")):$customer->profile_image);
                    $data['created_at']        =   $customer->created_at;
                    array_push($datacustomer,$data);
                }
            }
            return response()->json([
                                    'result'=>config::get("common.onstatus"),
                                    'message'=>'success',
                                    'Customerprofile'=>$datacustomer
                                ]);     
        }       
        return response()->json([
                                'result'=>config::get("common.offstatus"),
                                'message'=>'Invalid Access!!'
                            ]);
	}

	public function store()
    {
    	if(input::get('customer_id') == "" || input::get('firstname') == "" || input::get('phone') == "" || input::get('email') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $customer_id        =   input::get('customer_id');
        $name               =   input::get('firstname');
        $phone_no           =   input::get('phone');
        $email_id           =   input::get('email');
        //AUTHENTICATE FOR CUSTOMER
        $customerauth       =   app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);
        if($customerauth    ==  "Success")
        {           
            $where          =   array('phone'=>$phone_no);
            $getphone       =   customer::doCheckExistMobile($where,$customer_id);
            if(!empty($getphone) && count($getphone) >= 1)
            {
                return response()->json(['Result'=>config::get("common.offstatus"),
                                        'message'=>'This Mobile Number is already registered with us!!'
                                        ]);
            }
            $whereemail     =   array('email'=>$email_id);
            $getemail       =   customer::doCheckExistEmail($whereemail,$customer_id);
            if(!empty($getemail) && count($getemail) >= 1)
            {
                return response()->json(['Result'=>config::get("common.offstatus"),
                                        'message'=>'This Email id is already registered with us!!'
                                        ]);
            }
            
            $getcustomer    =   customer::where('id',$customer_id)->first();
            if(!empty($getcustomer) && count($getcustomer) >= 1)
            {                
                $getcustomer['email']    =   $email_id;
                $getcustomer['phone']    =   $phone_no;
                $getcustomer['customer_name']    =   $name;
                $success    =   $getcustomer->save();
                if($success >= 1)
                {
                    return response()->json([
                                'result'=>config::get("common.onstatus"),
                                'message'=>'Profile Updated Successfully!!'
                            ]);
                }
                else
                {
                    return response()->json(['Result'=>config::get("common.offstatus"),
                                            'message'=>'Please try again!!'
                                            ]);
                }
            }
            return response()->json([
                                    'result'=>config::get("common.offstatus"),
                                    'message'=>'Please try again!!'
                                ]);     
        } 
        else
        {
            return response()->json([
                                    'result'=>config::get("common.offstatus"),
                                    'message'=>'Invalid Access!!'
                                ]);
        }
    }
    
    public function doForgetpassword()
    {
        if(input::get('email') == "")
        {
            return response()->json(['Result'=>config::get("common.offstatus"),
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $email          =   input::get('email');        
        $wherepassword  =   array('email'=>$email);
        $getcustomer    =   customer::where($wherepassword)->first();
        if(!empty($getcustomer) && count($getcustomer) >= 1)
        {
            //return view('forgetpassword');
            $sendemail  =   ($getcustomer->email == null?'':$getcustomer->email);
            $custname   =   ($getcustomer->customer_name == null?'':$getcustomer->customer_name);
            $getid      =   ($getcustomer->id == null?'':$getcustomer->id);
            $url        =   url("doChangeforgetPassword/".encrypt($getid));
            $data       =   array('title'=>'email test',
                                'message'=>'Forget Password Link',
                                'mail_subject'=>'Restaurant App',
                                'sendemail'=>$email,
                                'customer_id'=>$url,
                                'email'=>$custname
                                );
            Mail::send('forgetpassword',$data, function ($message)use($data)
            {
                $message->from('support@dealerplus.in', 'Forget Password');
                $message->to($data['sendemail'])
                ->subject($data['mail_subject']);
            });
            // Mail::send('forgetpassword', [$data], function ($message) use ($data)
            // {
            //     $message->from('support@dealerplus.in', 'Forget Password');
            //     $message->to($data['email'])
            //     ->subject($data['mail_subject'])
            //     ->$message->sender($address, $name = null);
            // });
            // Mail::raw($emailmessage, function($message)
            // {
            //     $message->from('support@dealerplus.in', 'Forget Password');

            //     $message->to('vinoth.t@falconnect.in');
            // });

            return response()->json([
                        'result'=>config::get("common.onstatus"),
                        'message'=>'Forget Password link has been sent to your mail id.Reset your password and login again!!'
                    ]);
        }
        return response()->json([
                                'result'=>config::get("common.offstatus"),
                                'message'=>'No Emailid found please try again..'
                            ]);     
    }

    public function doChangeProfileimage()
    {
        if(input::get('customer_id') == "" || input::get('profile_image') == "")
        {
            return response()->json(['Result'=>config::get("common.offstatus"),
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $customer_id        =   input::get('customer_id');
        $profile_image      =   input::get('profile_image');
        //AUTHENTICATE FOR CUSTOMER
        $customerauth       =   app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);
        if($customerauth    ==  "Success")
        {           
            $where          =   array('id'=>$customer_id,'status'=>config::get("common.onstatus"));
            $getcustomer    =   customer::where($where)->first();
            if(!empty($getcustomer) && count($getcustomer) >= 1)
            {
                if(!empty($profile_image))
                {
                    $setuserimage       =   'data:image/png;base64,';
                    $userimage          =   $setuserimage.$profile_image;
                    $base64_img_array   =   explode(':', $userimage);
                    $img_info           =   explode(',', end($base64_img_array));
                    $img_file_extension = '';
                    if (!empty($img_info)) {
                        switch ($img_info[0]) {
                            case 'image/jpeg;base64':
                                $img_file_extension = 'jpeg';
                                break;
                            case 'image/jpg;base64':
                                $img_file_extension = 'jpg';
                                break;
                            case 'image/gif;base64':
                                $img_file_extension = 'gif';
                                break;
                            case 'image/png;base64':
                                $img_file_extension = 'png';
                                break;
                        }
                    }
                    $contactimage   =   'customer'.rand(2323211111,9999999999).'.'.$img_file_extension;
                    if(file_exists(public_path('/assets/img/customer/')))
                    {
                        
                    }
                    else
                    {
                        File::makeDirectory(public_path('/assets/img/customer/'), 0777, true, true);
                    }
                    //check file is exist or not otherwise create file
                    if(file_exists(public_path('/assets/img/customer/')))
                    {
                        $img_file_name      =   public_path().'/assets/img/customer/'.$contactimage;
                        $img_file           =   file_put_contents($img_file_name, base64_decode($img_info[1]));
                        $contactnewimage    =   url('assets/img/customer/'.$contactimage);
                    }
                    else
                    {
                        File::makeDirectory(public_path('/assets/img/customer/'), 0777, true, true);
                        $img_file_name      =   public_path().'/assets/img/customer'.$contactimage;
                        $img_file           =   file_put_contents($img_file_name, base64_decode($img_info[1]));
                        $contactnewimage    =   url('assets/img/customer/'.$contactimage);
                    }
                }
                else
                {
                    $contactnewimage            =   url(config::get("common.profilenoimage"));
                }

                $getcustomer['profile_image']   =   $contactnewimage;
                $success    =   $getcustomer->save();
                if($success >= 1)
                {
                    return response()->json([
                                'result'=>1,
                                'message'=>'Profile image Uploaded Successfully!!'
                            ]);
                }
                else
                {
                    return response()->json(['Result'=>config::get("common.offstatus"),
                                            'message'=>'Profile image not Uploaded Successfully!!'
                                            ]);
                }
            }
            return response()->json([
                                    'result'=>config::get("common.offstatus"),
                                    'message'=>'Invalid Access!!'
                                ]);     
        } 
        else
        {
            return response()->json([
                                    'result'=>config::get("common.offstatus"),
                                    'message'=>'Invalid Access!!'
                                ]);
        }
    }

    public function doChangePassword()
    {
        if(input::get('customer_id') == "" || input::get('oldpassword') == "" || input::get('newpassword') == "" || input::get('confirmpassword') == "")
        {
            return response()->json(['Result'=>config::get("common.offstatus"),
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $customer_id        =   input::get('customer_id');
        $oldpassword        =   input::get('oldpassword');
        $newpassword        =   md5(input::get('newpassword'));
        $confirm_password   =   md5(input::get('confirmpassword'));
        //AUTHENTICATE FOR CUSTOMER
        $customerauth       =   app('App\Http\Controllers\Api\Customerauthentication')->customerAuth($customer_id);
        if($customerauth    ==  "Success")
        {           
            //PASSWORD HASH ALGORITHM
            $haspassword    =   md5($oldpassword);
            $wherepassword  =   array('id'=>$customer_id,'password'=>$haspassword);
            $getcustomer    =   customer::where($wherepassword)->first();
            if(!empty($getcustomer) && count($getcustomer) >= 1)
            {
                if($newpassword == $confirm_password)
                {
                    $getcustomer['password']    =   $confirm_password;
                    $success    =   $getcustomer->save();
                    if($success >= 1)
                    {
                        return response()->json([
                                    'result'=>config::get("common.onstatus"),
                                    'message'=>'Password Updated Successfully!!'
                                ]);
                    }
                    else
                    {
                        return response()->json(['Result'=>config::get("common.offstatus"),
                                                'message'=>'Please try again!!'
                                                ]);
                    }
                }
            }
            return response()->json([
                                    'result'=>config::get("common.onffstatus"),
                                    'message'=>'Invalid Old Password'
                                ]);     
        } 
        else
        {
            return response()->json([
                                    'result'=>config::get("common.offstatus"),
                                    'message'=>'Invalid Access!!'
                                ]);
        }
    }
}