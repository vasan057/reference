@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Customers Address</h3>
    <div class="clearfix"></div><br>
    <div class="row"><div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div></div>
    <form action="{{url('/customeraddress/edit')}}" method="post">
        <input type="hidden" name="txt_customerId" value="{{encrypt($address->customer_id)}}">
        <input type="hidden" name="txt_id" value="{{$address->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6"><label>Address</label>
            <textarea type="text" name="txtar_address" class="form-control">{{$address->address}}</textarea>
        </div>
        <div class="col-xs-12 col-md-6"><label>Address Type</label>
            <select name="ddl_addressType" class="form-control">
                <option value="0">---SELECT---</option>
                @foreach($addressType as $addr)
                    <option value="{{$addr->id}}"<?php if($addr->id == $address->address_type_id) echo "selected='selected'"; ?>>{{$addr->address_type_desc}}</option>
                @endforeach
            </select>
        </div>
        <div class="clearfix"></div><br>
        <div class="col-xs-12 col-md-6"><label>Latitude</label>
            <input type="text" name="txt_latitude" class="form-control" value="{{$address->latitude}}">
        </div>
        <div class="col-xs-12 col-md-6"><label>Logitude</label>
            <input type="text" name="txt_logitude" class="form-control" value="{{$address->longitude}}">
        </div>
        <div class="clearfix"></div><br>  

        <div class="col-xs-12 col-md-6"><label>City</label>
            <select name="ddl_city" class="form-control">
                <option value="0">---SELECT---</option>
                @foreach($city as $cities)
                    <option value="{{$cities->id}}" <?php if($cities->id == $address->city_id) echo "selected='selected'"; ?>>{{$cities->city_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">
            <input type="submit" name="btn_updateCustomerAddress" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection