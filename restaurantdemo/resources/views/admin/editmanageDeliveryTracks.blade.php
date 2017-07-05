@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Delivery Tracks</h3>
    <div class="clearfix"></div><br>
    <div class="row"><div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div></div>
    <form action="{{url('/deliveryTracks/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$deliveryTracks->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6">
            <label>Estimated Time</label>
            <div class="input-group date" id="datetimepicker4" >
                <input type="text" name="txt_esttime" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="{{$deliveryTracks->estimated_time}}">
                <span class="input-group-addon testdrivepoint-outer">
                    <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                </span>
            </div>
        </div>
        <div class="col-xs-12 col-md-6"><label>Customer</label>
            <select class="form-control" name="ddl_customer" id="ddl_customer">
                <option value="0">---SELECT---</option>
                @foreach($customer as $cust)
                    <option value="{{$cust->id}}" <?php if($cust->id == $deliveryTracks->customer_id) echo "selected = 'selected'"; ?>>{{$cust->customer_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6"><label>Bill Id</label>
            <select class="form-control" name="ddl_billId" id="ddl_billId">
                <option value="0">---SELECT---</option>
                @foreach($bill as $bills)
                    <option value="{{$bills->id}}" <?php if($bills->id == $deliveryTracks->bill_id) echo "selected='selected'"; ?>>{{$bills->id}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-xs-12 col-md-6"><label>Order Status Id</label>
            <select name="ddl_orderStatus" class="form-control">
                <option value="0">---SELECT---</option>
                @foreach($orderStatus as $ordrStatus)
                    <option value="{{$ordrStatus->id}}" <?php if($ordrStatus->id == $deliveryTracks->order_status_id) echo "selected='selected'"; ?>>{{$ordrStatus->order_status_desc}}</option>
                @endforeach
            </select>
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_updateDeliveryTracks" value="Update" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
$("#ddl_customer").change(function () {
    var customerId = $(this).val();
    token = "{{ csrf_token() }}";
    $.ajax({
        type: "GET",
        url: "{{url('getCustomerBillAjax')}}?customerId=" + customerId,
        success: function (res)
        {
            $("#ddl_billId").empty();
            $("#ddl_billId").append('<option value="0">---SELECT---</option>');
            $.each(res, function (key, value)
            {
                $("#ddl_billId").append('<option value="' + value.id + '">' + value.id + '</option>');
            });
        }
    });
});
</script>
<script>$('.date').datetimepicker({
    autoclose: true,
            startView: "month",
            minView: "month",
            maxView: "decade"
            });
</script>
@endsection