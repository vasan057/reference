@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Order Type</h3>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addOrderType">ADD</button>
    <div class="clearfix"></div><br>

    <div class="clearfix"></div>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Order Type</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_type as $i => $order)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$order->order_type_name}}</td>
                <td><p class="label label-success">Status</p></td>
                @php
                $orderId = encrypt($order->id);
                @endphp
                <td>
                    <a href="{{url('/manageOrderTypes/edit/'.$orderId)}}"  class="btn btn-danger">Edit</a>
                </td>
                <td>
                    <a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$order->id}}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="addOrderType" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/manageOrderTypes/add')}}" method="post">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Order Type</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Order Type</label>
                        <input type="text" name="txt_addorderType" class="form-control">
                    </div>
                </div>
                <div class="clearfix"></div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_saveOrderType">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageOrderTypes/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_orderTypeId">
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
    $('#deleteModel').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-body input').val(recipient)
    })
</script>
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
@endsection