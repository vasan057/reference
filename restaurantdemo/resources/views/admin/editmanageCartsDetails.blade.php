@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Carts Details</h3>
    <div class="clearfix"></div><br>
    <div class="row">
        <div class="col-xs-12 col-md-2 pull-right btn-lg">
            <p class="label label-success">Status</p>
        </div>
    </div>
    <form action="{{url('/manageCartsdetails/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$cartDets->id}}">
        {{csrf_field()}}
         <div class="col-xs-12 col-md-6"><label>Customer Name</label>
                <select class="form-control" name="ddl_customer">
                    <option value="0">---SELECT---</option>
                    @foreach($customer as $custmr)
                        <option value="{{$custmr->id}}" <?php if($custmr->id == $cartDets->customers_id) echo "selected='selected'"; ?>>{{$custmr->customer_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12 col-md-6"><label>Item</label>
                <select class="form-control" name="ddl_items" id="ddl_items">
                    <option value="0">---SELECT---</option>
                    @foreach($items as $item)
                        <option value="{{$item->id}}" <?php if($item->id == $cartDets->item_id)echo "selected='selected'"; ?>>{{$item->item_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12 col-md-6"><label>Quantity</label>
                <input type="text" name="txt_quantity" class="form-control" id="txt_quantity" value="{{$cartDets->quanitity}}">
            </div>

            <div class="col-xs-12 col-md-6"><label>Amount</label>
                <input type="text" name="txt_amount" class="form-control" id="txt_amount" readonly value="{{$cartDets->amount}}">
            </div>
            <div class="clearfix"></div><br>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_updateCartDetails" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(function () {
        $("#ddl_items").change(function () {
            var itemId = $(this).val();
            token = "{{ csrf_token() }}";
            $.ajax({
                type: "GET",
                url: "{{url('getItemsAjax')}}?itemId=" + itemId,
                success: function (res)
                {
                    $('#txt_amount').empty();
                    $('#txt_amount').val(res[0].item_price);
                    $('#txt_quantity').val('1');
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $("#txt_quantity").keyup(function(){
        var quanitity       = $(this).val();
        var unitCost        = $('#txt_amount').val();
        var totalAmount     = quanitity * unitCost;
        $("#txt_amount").val(totalAmount);
    });
</script>
@endsection