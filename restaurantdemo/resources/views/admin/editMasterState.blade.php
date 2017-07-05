@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
	<h3>Edit Master State</h3>
    <div class="clearfix"></div><br>
    <div class="row">
    	<div class="col-xs-12 col-md-2 pull-right btn-lg">
    		<p class="label label-success">Status</p>
    	</div>
    </div>

    <form action="{{url('/manageMasterState/edit')}}" method="post">

        <input type="hidden" name="txt_id" value="{{$state->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6">
         	<label>Country Id</label>
			<select name="ddl_country" class="form-control">
	        	<option value="0">---SELECT---</option>
	        	@foreach($country as $count)
	        		<option value="{{$count->id}}" <?php if($count->id == $state->country_id) echo"selected = 'selected'"; ?>>{{$count->country_name}}</option>
	        	@endforeach
	        </select>
		</div>
		<div class="clearfix"></div><br>

		<div class="col-xs-12 col-md-6"><label>State Name</label>
		    <input type="text" name="txt_statename" class="form-control" value="{{$state->state_name}}">
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

            <input type="submit" name="btn_update" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>$('.date').datetimepicker({
    autoclose: true,
            format: "yyyy-mm-dd",
            startView: "month",
            minView: "month",
            maxView: "decade"
            });
</script>
@endsection