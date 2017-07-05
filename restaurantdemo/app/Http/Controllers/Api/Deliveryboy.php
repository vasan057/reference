<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Order;
use App\Model\delivery_track;
use App\Model\Orders_history;
use Config;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class Deliveryboy extends Controller
{
    public function DeliveryboyLogin(Request $request)
    {
        if(input::get('emailid') == "" || input::get('password') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $datainput          =   $request->all();
        $whereemployee      =   array('email'=>$datainput['emailid'],
                                        'password'=>md5($datainput['password']),
                                        'user_types_id'=>config::get("common.deliveryboy")
                                    );
        $employeelogin      =   Users::where($whereemployee)->first();
        if(count($employeelogin) >= 1)
        {
            $employeelogin['user_present_status']   =   config::get("common.onstatus");
            $employeelogin->save();
        }
        if(!empty($employeelogin) && count($employeelogin)  >=  1)
        {
            $data['id']     =   $employeelogin->id;
            $data['name']   =   $employeelogin->name;
            $data['email']  =   $employeelogin->email;
            $data['status'] =   $employeelogin->status;
            $data['phone']  =   $employeelogin->phone_number;
            switch($employeelogin->user_present_status)
            {
                case 0:
                $data['present_status']  =   "Offline";
                break;
                case 1:
                $data['present_status']  =   "Online";
                break;    
                default:
                $data['present_status']  =   "Online";
                break;
            }
            return response()->json(['Result'=>config::get("common.onstatus"),
                                    'message'=>'login sucessfull',
                                    'deliveryboydetails'=>[$data]
                                    ]);
        }
        else
        {
            return response()->json(['Result'=>config::get("common.offstatus"),
                                    'message'=>'Invalid Emailid or password Plase try again!!'
                                    ]);
        }
    }

    public function DeliveryboyProfile(Request $request)
    {
        if(input::get('deliverboy_id') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $datainput          =   $request->all();
        $whereemployee      =   array('id'=>$datainput['deliverboy_id'],
                                        'user_types_id'=>config::get("common.deliveryboy")
                                        );
        $employeelogin      =   Users::where($whereemployee)->first();
        if(!empty($employeelogin) && count($employeelogin)  >=  1)
        {
            $data['id']     =   $employeelogin->id;
            $data['name']   =   $employeelogin->name;
            $data['email']  =   $employeelogin->email;
            $data['status'] =   $employeelogin->status;
            $data['phone']  =   $employeelogin->phone_number;
            switch($employeelogin->user_present_status)
            {
                case 0:
                $data['present_status']  =   "Offline";
                break;
                case 1:
                $data['present_status']  =   "Online";
                break;    
                default:
                $data['present_status']  =   "Online";
                break;
            }
            $data['imageurl']   =   url(config::get("common.profilenoimage"));
            return response()->json(['Result'=>config::get("common.onstatus"),
                                    'message'=>'success',
                                    'deliveryprofile'=>[$data]
                                    ]);
        }
        return response()->json(['Result'=>config::get("common.offstatus"),
                                'message'=>'Invalid Login!!'
                                ]);
    }

    public function DeliveryboyChangestatus(Request $request)
    {
        if(input::get('deliverboy_id') == "" || input::get('present_status') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $datainput          =   $request->all();
        $whereemployee      =   array('id'=>$datainput['deliverboy_id'],
                                        'user_types_id'=>config::get("common.deliveryboy")
                                        );
        $employeelogin      =   Users::where($whereemployee)->first();
        if(!empty($employeelogin) && count($employeelogin)  >=  1)
        {
            if($datainput['present_status']  ==  config::get("common.onstatus"))
            {
                $employeelogin['user_present_status']   =   config::get("common.onstatus");
                $employeelogin->save();
                return response()->json(['Result'=>config::get("common.onstatus"),
                                        'message'=>'Successfully set online'
                                        ]);
            }
            else
            {
                $employeelogin['user_present_status']   =   config::get("common.offstatus");
                $employeelogin->save();
                return response()->json(['Result'=>config::get("common.onstatus"),
                                        'message'=>'Successfully set Offline'
                                        ]);
            }
        }
        return response()->json(['Result'=>config::get("common.offstatus"),
                                'message'=>'Invalid Delivery Boy!!'
                                ]);
    }

    public function DeliveryboyOrders(Request $request)
    {
        if(input::get('deliverboy_id') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $datainput          =   $request->all();
        $whereemployee      =   array('id'=>$datainput['deliverboy_id'],
                                        'user_types_id'=>config::get("common.deliveryboy"),
                                        'user_present_status'   =>   config::get("common.onstatus")
                                        );
        $employeelogin      =   Users::where($whereemployee)->first();
        if(!empty($employeelogin) && count($employeelogin)  >=  1)
        {
            $deliveryorders     =   delivery_track::getDeliveryBoyOrders($datainput['deliverboy_id']);

            return response()->json(['Result'=>config::get("common.onstatus"),
                                    'message'=>'success',
                                    'orderlist'=>$deliveryorders
                                    ]);
        }
        return response()->json(['Result'=>config::get("common.offstatus"),
                                'message'=>'Invalid Delivery Boy!!'
                                ]);
    }

    public function DeliveryboyOrdersitems(Request $request)
    {
        if(input::get('deliverboy_id') == "" || input::get('order_id') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $datainput          =   $request->all();
        $whereemployee      =   array('id'=>$datainput['deliverboy_id'],
                                        'user_types_id'=>config::get("common.deliveryboy"),
                                        'user_present_status'   =>config::get("common.onstatus")
                                        );
        $employeelogin      =   Users::where($whereemployee)->first();
        if(!empty($employeelogin) && count($employeelogin)  >=  1)
        {
            $deliveryorders     =   delivery_track::getDeliveryOrderdetails($datainput['order_id']);
            $getamount          =   $deliveryorders->sum('amount');
            return response()->json(['Result'=>config::get("common.onstatus"),
                                    'message'=>'success',
                                    'Ordersamount'=>$getamount,
                                    'orderlist'=>$deliveryorders
                                    ]);
        }
        return response()->json(['Result'=>config::get("common.offstatus"),
                                'message'=>'Invalid Delivery Boy!!'
                                ]);
    }

    public function DeliveryboyUpdatelocation(Request $request)
    {
        if(input::get('deliverboy_id') == "" || 
            input::get('latitude') == "" || input::get('longitude') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $datainput          =   $request->all();
        $whereemployee      =   array('id'=>$datainput['deliverboy_id'],
                                        'user_types_id'=>config::get("common.deliveryboy"),
                                        'user_present_status'   =>config::get("common.onstatus")
                                        );
        $employeelogin      =   Users::where($whereemployee)->first();
        if(!empty($employeelogin) && count($employeelogin)  >=  1)
        {
            $where          =   array('users_id'=>$datainput['deliverboy_id'],
                                        'status'=>config::get("common.onstatus")
                                        );
            $getlatitute    =   delivery_track::where($where)->first();
            if(count($getlatitute)>=1)
            {
                $getlatitute['latitude']    =   $datainput['latitude'];
                $getlatitute['longitude']   =   $datainput['longitude'];
                $getlatitute->save();
                return response()->json(['Result'=>config::get("common.onstatus"),
                                        'message'=>'success',
                                        'trackinfo'=>[$getlatitute]
                                        ]);
            }
        }
        return response()->json([
                                'result'=>config::get("common.offstatus"),
                                'message'=>'Invalid Access!!'
                            ]);
    }

    public function DeliveryboyDeliveredstatus(Request $request)
    {
        if(input::get('deliverboy_id') == "" ||
            input::get('orderid') == "" || input::get('delivered_status') == "")
        {
            return response()->json(['Result'=>'0',
                                    'message'=>'All fields are required!!'
                                    ]);
        }
        $datainput          =   $request->all();
        $whereemployee      =   array('id'=>$datainput['deliverboy_id'],
                                        'user_types_id'=>config::get("common.deliveryboy"),
                                        'user_present_status'   =>config::get("common.onstatus")
                                        );
        $employeelogin      =   Users::where($whereemployee)->first();
        if(!empty($employeelogin) && count($employeelogin)  >=  1)
        {
            $where          =   array('users_id'=>$datainput['deliverboy_id'],
                                        'status'=>config::get("common.onstatus")
                                        );
            $gettracksorder     =   delivery_track::where($where)->first();
            if(count($gettracksorder)>=1)
            {
                if($datainput['delivered_status'] ==    1)
                {
                    $whereorder     =   array('id'=>$datainput['orderid'],
                                        'status'=>config::get("common.onstatus")
                                        );
                    $getorders      =   Order::where($whereorder)->first();

                    if(count($getorders)>=1)
                    {
                        $getorders['order_status_id']   =   14;
                        $getorders->save();
                    }
                }

                if($datainput['delivered_status'] ==    0)
                {
                    $whereorder     =   array('id'=>$datainput['orderid'],
                                        'status'=>config::get("common.onstatus")
                                        );
                    $getorders      =   Order::where($whereorder)->first();

                    if(count($getorders)>=1)
                    {
                        $getorders['order_status_id']   =   14;
                        $getorders['remarks']   =   $datainput['remarks'];
                        $getorders->save();
                    }
                }

                $Orders_history                 =   new  Orders_history();
                $Orders_history['order_date']   =   Carbon::now();
                $Orders_history['status']       =   config::get("common.onstatus");
                $Orders_history['order_status_id']   =   14;
                $Orders_history['order_id']     =   $datainput['orderid'];
                $Orders_history->save();

                $gettracksorder['order_status_id']     =   14;
                $gettracksorder->save();
                return response()->json(['Result'=>config::get("common.onstatus"),
                                        'message'=>'Successfully Changed Status'
                                        ]);
            }
            else
            {
                return response()->json(['Result'=>config::get("common.offstatus"),
                                        'message'=>'Please try again'
                                        ]);

            }
        }
        return response()->json([
                                'result'=>config::get("common.offstatus"),
                                'message'=>'Invalid Access!!'
                            ]);
    }
    public function send_notification()
    {
            //$userdetails    =   $this->user->userdetails($id);
        $userdetails['app_id']  =   'APA91bFpyv-KmP9qeRMCp8Fuhsuns4XEH509Fytg8iHDOgvC2BAUKkrbhJhyFBk4unAdFGuPo8HMl9Evl5VYeATFcK5aNBuSX869AzY85uRmJwSg78a3O22w9zfTlLofTWzVmoNFqUl4a';
        $userdetails['deviceType']  =   'Android';
        if($userdetails['deviceType'] =='Android')
        {
            // API access key from Google API's Console
            define( 'API_ACCESS_KEY', 'AIzaSyAG8wvkeR45LsFcE2WEIyu1t2g400O1moI' );
            $registrationIds['0']   =   $userdetails['app_id'];
            // prep the bundle
            $msg    =   array
            (
            'message'  => "Restaurant App",
            'title'  => "Test message",
            'subtitle' => 'This is a subtitle. subtitle',
            'tickerText' => 'Ticker text here...Ticker text here...Ticker text here',
            'vibrate' => 1,
            'sound'  => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon'
            );
            $fields = array
            (
                'registration_ids'  => $registrationIds,
                'data'   => $msg
            );
            $headers = array
            (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );
            
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            print_r($result); exit;
            curl_close( $ch );
        }
        // else
        // {
        //     $this->apple_push($userdetails);
        // }
           //echo $result;
            //$this->load->view('admin/users/send_notification',$this->data);
    }
}