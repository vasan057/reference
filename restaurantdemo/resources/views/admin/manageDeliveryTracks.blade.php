@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Delivery Tracks</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-danger" data-toggle="modal" data-target="#adddeliverytracks">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Estimated Time</th>
                <th>Customer Id</th>
                <th>Bill Id</th>
                <th>Order Status Id</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deliveryTracks as $i => $delivery)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$delivery->estimated_time}}</td>
                <td>{{$delivery->customer_name}}</td>
                @php 
                $deliveryId = encrypt($delivery->deliveryId);
                @endphp
                <td>{{$delivery->billId}}</td>
                <td>{{$delivery->order_status_desc}}</td>
                <td><p class="label label-success">Status</p></td>

                <td><a href="{{url('/deliveryTracks/edit/'.$deliveryId)}}" class="btn btn-primary">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$delivery->deliveryId}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="adddeliverytracks" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/deliveryTracks/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Delivery Tracks</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Estimated Time</label>
                        <div class="input-group date" id="datetimepicker4" >
                            <input type="text" name="txt_esttime" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Customer</label>
                        <select class="form-control" name="ddl_customer" id="ddl_customer">
                            <option value="0">---SELECT---</option>
                            @foreach($customer as $cust)
                            <option value="{{$cust->id}}">{{$cust->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Bill Id</label>
                        <select class="form-control" name="ddl_billId" id="ddl_billId">
                            <option value="0">---SELECT---</option>
                        </select>
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Order Status Id</label>
                        <select name="ddl_orderStatus" class="form-control">
                            <option value="0">---SELECT---</option>
                            @foreach($orderStatus as $ordrStatus)
                            <option value="{{$ordrStatus->id}}">{{$ordrStatus->order_status_desc}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div><br>  
                <div class="modal-footer">
                    <input type="submit" name="btn_saveDeliveryTracks" value="Save" class="btn btn-default">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/deliveryTracks/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_deliveryTrackId">
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
<script>
    $('.date').datetimepicker({
        autoclose: true,
        startView: "month",
        minView: "month",
        maxView: "decade"
    });</script>
<script>
    $(document).ready(function () {
        $('#users').DataTable();
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