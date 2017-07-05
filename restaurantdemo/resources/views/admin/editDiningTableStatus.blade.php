@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
	<h3>Dining Table Status</h3> 
	<div class="clearfix"></div><br>
	<form method="post" action="{{url('/manageDinningTableStatus/edit')}}">
		{{csrf_field()}}
		<input type="hidden" name="txt_id" value="{{$dinningStatus->id}}">
		<div class="col-xs-6 col-md-offset-3"><label>Dining Table Status</label>
		    <input type="text" name="txt_diningstatus" class="form-control" value="{{$dinningStatus->status}}">
		</div>
		<div class="clearfix"></div><br>
		<input type="submit" name="btn_updateDinningTableStatus" value="Update" class="btn btn-primary col-md-offset-3 col-md-1">
	</form>
</div>