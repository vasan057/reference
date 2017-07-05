@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
    <h3>Edit Restaurant</h3>
    <br/>
    <div class="row">
        <div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div>
    </div>
    <div class="clearfix"></div><br/>
    <form method="post" action="{{url('/manageRestaurents/edit')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="txt_id" value="{{$restaurant->id}}">
        <div class="col-xs-12 col-md-6">
            <label>Restaurant Name</label>
            <input type="text" name="txt_restaurantName" class="form-control" value="{{$restaurant->restaurant_name}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Restaurant Address</label>
            <textarea class="form-control" name="txt_restaurantAddress">{{$restaurant->address}}</textarea>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Latitiude</label>
            <input type="text" name="txt_latitude" class="form-control" value="{{$restaurant->latitude}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Longitude</label>
            <input type="text" name="txt_longitude" class="form-control" value="{{$restaurant->longitude}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Phone Number</label>
            <input type="text" name="txt_phone" class="form-control" value="{{$restaurant->phone_number}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>About</label>
            <textarea class="form-control" name="txtar_restDesc">{{$restaurant->about_restaurant}}</textarea>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Image</label>
            <input type="file" name="fl_restImg" accept="image/*">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>User</label>
            <select class="form-control" name="ddl_users">
                <option value="0">---SELECT---</option>
                @foreach($user as $usr)
                    <option value="{{$usr->id}}" <?php if($usr->id == $restaurant->user_id) echo "selected = 'selected'"; ?>>{{$usr->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>City</label>
            <select class="form-control" name="ddl_city">
                <option value="0">---SELECT---</option>
                @foreach($city as $cities)
                    <option value="{{$cities->id}}" <?php if($cities->id == $restaurant->city_id) echo "selected='selected'"; ?>>{{$cities->city_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Opening Hours</label>
            <input type="text" name="txt_openinghr" class="form-control" value="{{$restaurant->opening_hours}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Closing Hours</label>
            <input type="text" name="txt_closinghr" class="form-control" value="{{$restaurant->closing_hours}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Delivery Opening Hours</label>
            <input type="text" name="txt_delopenhr" class="form-control" value="{{$restaurant->delivery_opening_hours}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Delivery Closing Hours</label>
            <input type="text" name="txt_delclosehr" class="form-control" value="{{$restaurant->delivery_closing_hours}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Price Range</label>
            <input type="text" name="txt_priceRange" class="form-control" value="{{$restaurant->price_range_info}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Minimum Home Delivery</label>
            <input type="text" name="txt_minHomeDelivery" class="form-control" value="{{$restaurant->min_home_delivery_amount}}">
        </div>

        <div class="col-xs-12 col-md-6">
            <label>Average Rating</label>
            <input type="text" name="txt_rating" class="form-control" value="{{$restaurant->average_rating}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Directions</label>
            <input type="text" name="txt_direct" class="form-control" value="{{$restaurant->directions}}">
        </div>
        <br>
        <div class="col-xs-12 col-md-2">
            <div class="checkbox">
                <label><input type="checkbox" name="chk_homeDelivery" value="1" <?php if($restaurant->has_home_delivery == "1") echo "checked='checked'"; ?>>Home Delivery</label>
            </div>
        </div>
        <div class="col-xs-12 col-md-2">
            <div class="checkbox">
                <label><input type="checkbox" name="chk_tableBooking" value="1" <?php if($restaurant->has_table_booking == "1") echo "checked='checked'"; ?>>Table Booking</label>
            </div>
        </div>
        <div class="col-xs-12 col-md-2">
            <div class="checkbox">
                <label><input type="checkbox" name="chk_pickup" value="1" <?php if($restaurant->has_pickup == "1") echo "checked='checked'"; ?>>Pickup</label>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <div class="pull-right">
                <input type="submit" class="btn btn-primary " value="UPDATE" name="btn_updateRestaurent">
            </div>
        </div>
    </form>
</div>

@endsection