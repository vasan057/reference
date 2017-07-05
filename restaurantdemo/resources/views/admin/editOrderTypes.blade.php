@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
    <h3>Order Type</h3>
    <form method="post" action="{{url('/manageOrderTypes/edit')}}">
    	{{csrf_field()}}
    	<input type="hidden" name="txt_id" value="{{$order_type->id}}">
		<div class="col-xs-12 col-md-6"><label>Order Type</label>
		    <input type="text" name="txt_editorderType" class="form-control" value="{{$order_type->order_type_name}}">
		</div>
		<!-- <div class="col-xs-12 col-md-6">
		    <label>Status</label>
		    <select class="form-control" name="txt_status">
		        <option value="0">Select Status</option>
		        <option value="1">Status</option>
		        <option value="2">Status</option>
		    </select>
		</div> -->
		<div class="clearfix"></div><br>
		<input type="submit" name="btn_updateOrder" class="btn btn-primary" value="UPDATE">
	</form>
</div>

@endsection