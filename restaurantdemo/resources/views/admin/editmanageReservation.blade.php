@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Manage Resrvation</h3>
    <div class="clearfix"></div><br>
    <div class="row"><div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div></div>
    <form action="{{url('/manageReservation/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$reservation->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6">
            <label>Reservation Date</label>
            <div class="input-group date" id="datetimepicker4">
                <input type="text" name="txt_reservationdate" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="{{$reservation->reservation_date}}">
                <span class="input-group-addon testdrivepoint-outer">
                    <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                </span>
            </div>
        </div>
        <div class="clearfix"></div><br>

        <div class="col-xs-12 col-md-6"><label>Customer</label>
            <select name="ddl_customer" class="form-control">
                <option value="0">---SELECT---</option>
                @foreach($customer as $cust)
                    <option value="{{$cust->id}}" <?php if($cust->id == $reservation->customer_id) echo "selected='selected'"; ?>>{{$cust->customer_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="clearfix"></div><br>   

        <div class="col-xs-12 col-md-6"><label>Dining Table</label>
            <select name="ddl_dinningTable" class="form-control">
                <option value="0">---SELECT---</option>
                @foreach($dinningTable as $dinning)
                    <option value="{{$dinning->id}}" <?php if($dinning->id == $reservation->dining_table_id) echo "selected='selected'"; ?>>{{$dinning->chairs_count}}</option>
                @endforeach
            </select>
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_updateReservation" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script> 
$(function () {
    $('#datetimepicker4').datetimepicker();
});
</script>
@endsection