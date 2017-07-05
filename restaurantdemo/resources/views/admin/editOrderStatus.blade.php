	
@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
	<h3>Order Status</h3>
	<div class="clearfix"></div><br>

	<form action="{{url('/manageOrderStatus/edit')}}" method="post">
		{{csrf_field()}}
		<input type="hidden" name="txt_id" value="{{$orderStatus->id}}">
		<div class="col-xs-12 col-md-4 col-md-offset-2"><label>Order Status</label>
		    <input type="text" name="txt_orderstatus" class="form-control" value="{{$orderStatus->order_status_desc}}">
		</div>
		<div class="clearfix"></div><br>
		<input type="submit" class="btn btn-primary col-md-1 col-md-offset-4" value="Update" name="btn_updateOrderStatus">
	</form>
</div>