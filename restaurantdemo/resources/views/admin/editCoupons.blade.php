@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
    <h3>Edit Coupons</h3><br>
    <div class="row">
    	<div class="col-xs-12 col-md-2 pull-right btn-lg">
    		<p class="label label-success">Status</p>
    	</div>
    </div>
	<div class="clearfix"></div><br/>
    <form method="post" action="{{url('/manageCoupon/edit/'.$coupon[0]->coupon_id)}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6"><label>Coupon Code</label>
            <input type="text" name="txt_couponcode" class="form-control" value="{{$coupon[0]->coupon_code}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Coupon Validity</label>
            <select class="form-control" name="ddl_couponvalidity">
                <option value="0">---SELECT---</option>
                <option value="1"<?php if($coupon[0]->coupon_validity == "1") echo "selected='selected'"; ?>>Invalid</option>
                <option value="2" <?php if($coupon[0]->coupon_validity == "2") echo "selected='selected'"; ?>>Valid</option>
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Coupon Start Date</label>
            <div class="input-group date" id="datetimepicker4" name="txt_couponsdate">
                <input type="text" name="txt_coupon_start_date" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="{{$coupon[0]->coupon_start_date}}">
                <span class="input-group-addon testdrivepoint-outer">
                    <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                </span>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Coupon End Date</label>
            <div class="input-group date" id="datetimepicker4" name="txt_couponedate">
                <input type="text" name="txt_coupon_end_date" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="{{$coupon[0]->coupon_end_date}}">
                <span class="input-group-addon testdrivepoint-outer">
                    <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                </span>
            </div>
        </div>
        <div class="col-xs-12 col-md-6"><label>Coupon Amount</label>
            <input type="text" name="txt_couponamt" class="form-control" value="{{$coupon[0]->coupon_amount}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Coupon Time Used</label>
            <input type="text" name="txt_coupontime" class="form-control" value="{{$coupon[0]->coupon_times_used}}" readonly>
        </div>
        <div class="col-xs-12 col-md-6"><label>Coupon Max Usage</label>
            <input type="text" name="txt_couponmxusg" class="form-control" value="{{$coupon[0]->coupon_max_usage}}">
        </div>
        <div class="col-xs-12 col-md-6"><label>Coupon Min Order Amount</label>
            <input type="text" name="txt_couponmnordamnt" class="form-control" value="{{$coupon[0]->coupon_min_order_amount}}">
        </div>
        <!-- <div class="col-xs-12 col-md-6"><label>Coupon allowed Percentage</label>
            <input type="text" name="txt_couponalwper" class="form-control" value="{{$coupon[0]->coupon_allowed_percent}}">
        </div> -->
       	<div class="col-xs-12 col-md-6"><label>Coupon Description</label>
			<textarea name="txtar_coupondes" class="form-control">{{$coupon[0]->coupon_descr}}</textarea>
        </div>
		<div class="col-xs-12 col-md-6">
		    <label>Coupon Visiblity</label>
		    <select class="form-control" name="ddl_couponvisibility">
		        <option value="0">---SELECT---</option>
		        <option value="Public"<?php if($coupon[0]->coupon_visibility == "Public") echo "selected='selected'";?>>Public</option>
		        <option value="Private" <?php if($coupon[0]->coupon_visibility == "Private") echo "selected='selected'";?>>Private</option>
		    </select>
		</div>
        <br>
        <div class="col-md-12">
        	<div class="pull-right">
        		<input type="submit" class="btn btn-primary " value="UPDATE" name="btn_updateCoupon">
        	</div>
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