@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Master Country</h3>
    <div class="clearfix"></div><br>
    <div class="row">
    	<div class="col-xs-12 col-md-2 pull-right btn-lg">
    		<p class="label label-success">Status</p>
    	</div>
    </div>
    <form action="{{url('/manageMasterCountry/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$country->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6">
        	<label>Country Name</label>
			<input type="text" name="txt_countryname" class="form-control" value="{{$country->country_name}}">
		</div>
		<!-- <div class="col-xs-12 col-md-6">
		    <label>created at</label>
		    <div class="input-group date" id="datetimepicker4" name="txt_createat">
		        <input type="text" name="txt_crtat" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
		        <span class="input-group-addon testdrivepoint-outer">
		            <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
		        </span>
		    </div>
		</div> -->
		<!-- <div class="col-xs-12 col-md-6">
		    <label>created at</label>
		    <div class="input-group date" id="datetimepicker4" name="txt_updateat">
		        <input type="text" name="txt_updtat" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
		        <span class="input-group-addon testdrivepoint-outer">
		            <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
		        </span>
		    </div>
		</div> -->
        <div class="clearfix"></div><br>
        <div class="col-xs-12">
            <input type="submit" name="btn_update" value="UPDATE" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection