<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table="users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUserDetails()
    {
        return user::where('user_types_id','!=','1')
                        ->select('users.id','name','email','user_type_name','users.status','restaurant_name','users.phone_number','user_present_status')
                        ->leftjoin('user_types','user_types.id','=','users.user_types_id')
                        ->leftjoin('restaurants','restaurants.id','=','users.restaurant_id')
                        ->get();
    }

}
