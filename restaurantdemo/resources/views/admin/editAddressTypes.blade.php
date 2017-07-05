@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
    <h3>Address Types</h3>
    <div class="clearfix"></div><br>

	<form action="{{url('/manageAddressTypes/edit')}}" method="post">
		{{csrf_field()}}
		<input type="hidden" name="txt_id" value="{{$addressType->id}}">
		<div class="col-xs-12 col-md-6"><label>Address Type</label>
			<input type="text" name="txt_addresstype" class="form-control" value="{{$addressType->address_type_desc}}">
		</div>
		<div class="clearfix"></div><br>
		<input type="submit" class="btn btn-primary" name="btn_updateAddressTypes" value="Update">
		<div class="clearfix"></div><br>
	</form>
</div>

@endsection