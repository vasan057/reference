@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Employee</h3>
    <div class="clearfix"></div><br>
    <form action="{{url('/manageEmployees/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$user->id}}">
        {{csrf_field()}} 
        <div class="col-xs-6">
            <label>Employee Name</label>
            <input value="{{$user->employee_name}}" type="text" name="txt_employeeName" class="form-control" >
        </div>
        <div class="col-xs-6">
            <label>Address</label>
            <textarea name="txtar_addr" class="form-control">{{$user->address}}</textarea>
        </div>
        <div class="clearfix"></div><br>
        <div class="col-xs-6">
            <label>Phone Number</label>
            <input type="text" name="txt_phno" value="{{$user->phone}}" class="form-control">
        </div>
        <div class="col-xs-6">
            <label>Positions</label>
            <select name="ddl_position" class="form-control">
                <option value="0" disabled>---SELECT---</option>
                @foreach($position as $positions)
                <option value="{{$positions->id}}" <?php if ($user->position_id == $positions->id) echo 'selected="selected"' ?>>{{$positions->position_title}}</option>
                @endforeach
            </select>
        </div>
        <div class="clearfix"></div><br>
        <div class="col-xs-12 col-md-6">
            <label>Restuarant</label>
            <select name="ddl_restaurant" class="form-control">
                <option value="0">---Select Restuarant---</option>
                @foreach($restaurant as $rest)
                <option value="{{$rest->id}}" <?php if ($rest->id == $user->restaurant_id) echo "selected = 'selected'"; ?>>{{$rest->restaurant_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>City</label>
            <select name="ddl_city" class="form-control">
                <option value="0" >---Select City---</option>
                @foreach($city as $cities)
                <option value="{{$cities->id}}" <?php if ($cities->id == $user->city_id) echo "selected='selected'"; ?>>{{$cities->city_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">
            <input type="submit" name="btn_updateEmployee" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection