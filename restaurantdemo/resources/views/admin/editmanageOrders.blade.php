@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Orders</h3>
    <div class="clearfix"></div><br>
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div class="progress">
    <div class="progress-bar progress-bar-success" style="width: 40%">
        <span class="sr-only">Program Files (40%)</span>
    </div>
    <div class="progress-bar progress-bar-warning" style="width: 25%">
        <span class="sr-only">Residual Files (25%)</span>
    </div>
    <div class="progress-bar progress-bar-danger" style="width: 15%">
        <span class="sr-only">Junk Files (15%)</span>
    </div>
</div>
        </div>
        <div class="col-xs-12 pull-right col-md-4">
            
            <div class="col-md-5 col-xs-12">
                <div><a class="btn btn-sm btn-primary pull-right" href="{{url('/manageBilling')}}">Generate Bill</a></div>
            </div>
            <div class="col-md-2  col-xs-12">
                <div class="btn btn-sm btn-primary pull-right">Track</div>
            </div>
            <div class="col-md-5  col-xs-12">
                <div class="label  label-success pull-right">Order Status</div>
            </div>
        </div>
    </div>
    <form action="{{url('/manageOrders/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$order->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6">
            <label>Order Date</label>
            <div class="input-group date" id="datetimepicker4">
                <input type="text" name="txt_orderdate" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="{{$order->order_date}}">
                <span class="input-group-addon testdrivepoint-outer">
                    <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                </span>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Order Type</label>
            <select class="form-control" name="ddl_ordertype">
                <option value="0">---SELECT</option>
                @foreach($Order_type as $orders)
                    <option value="{{$orders->id}}"<?php if($orders->id == $order->order_type_id) echo "selected='selected'"; ?>>{{$orders->order_type_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6"><label>Customer Name</label>
            <select class="form-control" name="ddl_cusname" id="ddl_cusname">
                <option value="0">---SELECT---</option>
                @foreach($customer as $cust)
                    <option value="{{$cust->id}}" <?php if($cust->id == $order->customer_id ) echo "selected='selected'"; ?>>{{$cust->customer_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6"><label>Customer Address</label>
            <select class="form-control" name="ddl_cusaddress" id="ddl_cusaddress">
                <option value="0">---SELECT---</option>
                @foreach($customerAddress as $custAddr)
                    <option value="{{$custAddr->id}}"<?php if($custAddr->id== $order->customer_address_id) echo "selected='selected'";  ?>>{{$custAddr->address}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Restaurant Name</label>
            <select class="form-control" name="ddl_restname">
                <option value="0">---SELECT---</option>
                @foreach($restaurant as $restrnt)
                    <option value="{{$restrnt->id}}" <?php if($restrnt->id== $order->restaurant_id) echo "selected='selected'"; ?>>{{$restrnt->restaurant_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6"><label>Order Status</label>
            <select class="form-control" name="ddl_ordestatus">
                <option value="0">---SELECT---</option>
                @foreach($Order_status as $ordrstatus)
                    <option value="{{$ordrstatus->id}}" <?php if($ordrstatus->id == $order->order_status_id) echo "selected='selected'"; ?>>{{$ordrstatus->order_status_desc}}</option>
                @endforeach
            </select>
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_updateOrder" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>

<div class="col-xs-12">
    <h3>Order Details</h3>
    <div class="col-xs-12 col-md-2 pull-right btn-lg"> <button class="btn btn-primary" data-toggle="modal" data-target="#addorderdet">Add Order Details</button> </div>
    <table id="users" class="table table-hover table-condensed" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Item details</th>
                <th>Item Name</th>
                <th>Item Quantity</th>
                <th>Unit Cost</th>
                <th>Total Cost</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order_details as $i => $orderDets)
                <tr>
                    <td>{{++$i}}</td>
                    <td><img src="{{url($orderDets->image_url)}}" class="col-md-2"></td>
                    <td>{{$orderDets->item_name}}</td>
                    <td>{{$orderDets->item_quanitity}}</td>
                    <td>{{$orderDets->amount}}</td>
                    <td>
                        {{$orderDets->item_quanitity*$orderDets->amount}}
                    </td>
                    <td><a class="btn btn-danger" data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$orderDets->id}}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addorderdet" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/manageOrdersdetails')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="txt_orderId" value="{{$order->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Order Details  </h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Item Name</label>
                        <select class="form-control" name="ddl_items" id="ddl_items">
                            <option value="0">---SELECT---</option>
                            @foreach($menuItems as $menuitem)
                                <option value="{{$menuitem->id}}">{{$menuitem->item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Item Quantity</label>
                        <input type="text" value="1" name="txt_itemQuantity" class="form-control" id="txt_itemQuantity">
                    </div>
                    <div class="clearfix"></div><br/>

                    <div class="col-xs-12 col-md-6"><label>Unit Cost</label>
                        <input type="text" name="txt_amount" class="form-control" readonly id="txt_amount">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Total Cost</label>
                        <input type="text" name="txt_totalCost" class="form-control" readonly id="txt_totalCost">
                    </div>
                </div>
                <div class="clearfix"></div><br/>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_SaveOrder">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageOrdersdetails/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_OrderItemId">
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="DELETE">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(function () {
        $("#ddl_cusname").change(function () {
            var customerId = $(this).val();
            token = "{{ csrf_token() }}";
            $.ajax({
                type: "GET",
                url: "{{url('getCustomerAddress')}}?customerId=" + customerId,
                success: function (res)
                {
                    //console.log(res);
                    $("#ddl_cusaddress").empty();
                    $("#ddl_cusaddress").append('<option value="0">---SELECT---</option>');
                    $("#ddl_cusaddress").append('<option value="' + res[0].id + '">' + res[0].address + '</option>');
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
<script type="text/javascript">
    $(function()
    {
        $('#ddl_items').change(function()
        {
            var itemid = $(this).val();
            token = "{{ csrf_token() }}";
            $.ajax({
                type:"GET",
                url:"{{url('getMenuItemPrice')}}?priceId="+itemid,
                success:function(res)
                {
                    $('#txt_amount').val(res[0].item_price);
                    var quantity = $("#txt_itemQuantity").val();
                    var unitcost = $("#txt_amount").val();
                    var totalamt = (quantity) * (unitcost);
                    //alert(totalamt);
                    $("#txt_totalCost").val(totalamt);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $("#txt_itemQuantity").keyup(function(){
        var quantity = $(this).val();
        var unitcost = $("#txt_amount").val();
        var totalamt = (quantity) * (unitcost);
        //alert(totalamt);
        $("#txt_totalCost").val(totalamt);
    });
</script>
<script type="text/javascript">
    $('#deleteModel').on('show.bs.modal', function (event) 
    {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever') 
        var modal = $(this)
        modal.find('.modal-body input').val(recipient)
    })
</script>
@endsection