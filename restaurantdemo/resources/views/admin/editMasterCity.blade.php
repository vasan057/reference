@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Master City</h3>
    <div class="clearfix"></div><br>
    <div class="row">
        <div class="col-xs-12 col-md-2 pull-right btn-lg">
            <p class="label label-success">Status</p>
        </div>
    </div>
    <form action="{{url('/manageMasterCity/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$city[0]->cityId}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6">
            <label>Country</label>
            <select class="form-control" name="ddl_country" id="ddl_country">
                <option value="0">---SELECT---</option>
                @foreach($country as $count)
                    <option value="{{$count->id}}" <?php if($count->id == $city[0]->countryId) echo "selected='selected'"; ?>>{{$count->country_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>State</label>
            <select name="ddl_state" id="ddl_state" class="form-control">
                <option value="0">---SELECT---</option>
                @foreach($allstates as $allcities)
                    <option value="{{$allcities->id}}" <?php if($allcities->id == $city[0]->stateId) echo "selected='selected'"; ?>>{{$allcities->state_name}}</option>
                @endforeach
            </select>
        </div>
         <div class="col-xs-12 col-md-6"><label>City Name</label>
            <input type="text" name="txt_cityname" class="form-control" value="{{$city[0]->city_name}}">
        </div>
         <div class="col-xs-12 col-md-6"><label>Popular Status</label>
            <select name="ddl_popularStatus" class="form-control">
                <option value="-1">---SELECT---</option>
                <option value="1" <?php if($city[0]->popular_status == "1") echo "selected='selected'"; ?>>POPULAR</option>
                <option value="0" <?php if($city[0]->popular_status == "0") echo "selected='selected'"; ?>>NON-POPULAR</option>
            </select>
        </div>
                     <!-- <div class="col-xs-12 col-md-6">
                        <label>created at</label>
                        <div class="input-group date" id="datetimepicker4" name="txt_createdate">
                            <input type="text" name="txt_crtat" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div> -->
                     <!-- <div class="col-xs-12 col-md-6">
                        <label>Updated at</label>
                        <div class="input-group date" id="datetimepicker4" name="txt_updatedate">
                            <input type="text" name="txt_uptat" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div> -->

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_updateCity" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(function(){
        $("#ddl_country").change(function(){
            var countryId = $(this).val();
            token = "{{ csrf_token() }}";
            $.ajax({
                type:"GET",
                url:"{{url('getState')}}?country_id="+countryId,
                success:function(res)
                {
                    //console.log(res);
                    $("#ddl_state").empty();
                    $("#ddl_state").append('<option value="0">---SELECT---</option>');
                    $.each(res,function(key,value)
                    {
                        $("#ddl_state").append('<option value="'+value.id+'">'+value.state_name+'</option>');
                    });
                }
            });
        });
    });
</script>
<script>$('.date').datetimepicker({
    autoclose: true,
            format: "yyyy-mm-dd",
            startView: "month",
            minView: "month",
            maxView: "decade"
            });
</script>
@endsection