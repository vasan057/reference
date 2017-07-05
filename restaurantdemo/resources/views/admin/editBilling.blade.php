@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
    <h3>Edit Billing</h3>
    <br/>
     <div class="row">
        <div class="col-xs-12 col-md-2 pull-right btn-lg">
            <p class="label label-success">Status</p>
        </div>
    </div>
    <div class="clearfix"></div>
    <br/>
    <form method="post" action="{{url('/manageBilling/edit/')}}">
        {{csrf_field()}}
        <input type="hidden" name="txt_id" value="{{$bill->id}}">
        <div class="col-xs-12 col-md-6">
            <label>Order Id</label>
            <select name="ddl_orderId" class="form-control" id="ddl_orderId">
                <option value="0">---SELECT---</option>
                @foreach($orderDets as $ordDets)
                    <option value="{{$ordDets->id}}" <?php if($ordDets->id == $bill->order_id) echo "selected='selected'"; ?>>{{$ordDets->order_date}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Bill Date</label>
            <div class="input-group date" id="datetimepicker4">
                <input type="text" name="txt_billdate" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="{{$bill->bill_date}}">
                <span class="input-group-addon testdrivepoint-outer">
                    <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                </span>
            </div>
        </div>
        <div class="clearfix"></div><br/>

        <div class="col-xs-12 col-md-6">
            <label>Amount</label>
            <input type="text" name="txt_amount" class="form-control" id="txt_amount" readonly value="{{$bill->amount}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Discount</label>
            <input type="text" name="txt_discount" class="form-control" id="txt_discount" value="{{$bill->discount}}">
        </div>
        <div class="clearfix"></div><br>

        <div class="col-xs-12 col-md-6"><label>Restuarant Id</label>
            <select class="form-control" name="ddl_restaurant" id="ddl_restaurant">
                <option value="0">---SELECT---</option>
                @foreach($restaurant as $rest)
                    <option value="{{$rest->id}}" <?php if($rest->id == $bill->restaurant_id) echo "selected='selected'"; ?>>{{$rest->restaurant_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12">
            <div class="pull-right">
                <input type="submit" class="btn btn-primary " value="UPDATE" name="btn_updateBill">
            </div>
        </div>
    </form>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
<script type="text/javascript">
        $("#ddl_orderId").change(function () {
            var orderId = $(this).val();
            token = "{{ csrf_token() }}";
            $.ajax({
                type: "GET",
                url: "{{url('getOrderDetsAjax')}}?orderId=" + orderId,
                success: function (res)
                {
                    //$("#txt_discount").empty();
                    $("#txt_amount").val(res[0].totalAmount);
                    $("#ddl_restaurant").val(res[0].restaurant_id)
                }
            });
        });
</script>
<script>
$('.date').datetimepicker({
    autoclose: true,
            format: "yyyy-mm-dd",
            startView: "month",
            minView: "month",
            maxView: "decade"
    });
</script>
@endsection