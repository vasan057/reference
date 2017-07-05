@extends('layouts.admin')

@section('content')

<div class="col-xs-12"  id="no-more-tables">
    <h3>Carts Details</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#addcartdet">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Customer Name</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart_deatils as $i => $cartDets)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$cartDets->customer_name}}</td>
                    <td>{{$cartDets->item_name}}</td>
                    <td>{{$cartDets->quanitity}}</td>
                    <td>{{$cartDets->amount}}</td>
                    @php 
                        $cartDetsId = encrypt($cartDets->id);
                    @endphp
                    <td><p class="label label-success">Status</p></td>
                    <td><a href="{{url('/manageCartsdetails/edit/'.$cartDetsId)}}" class="btn btn-danger">Edit</a></td>
                    <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$cartDets->id}}" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addcartdet" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageCartsdetails/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Cart Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Customer Name</label>
                        <select class="form-control" name="ddl_customer">
                            <option value="0">---SELECT---</option>
                            @foreach($customer as $custmr)
                                <option value="{{$custmr->id}}">{{$custmr->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="col-xs-12 col-md-6"><label>Carts</label>
                        <select class="form-control" name="ddl_carts">
                            <option value="0">---SELECT---</option>
                            @foreach($cart as $cartDets)
                                <option value="{{$cartDets->id}}">{{$cartDets->cart_name}}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="col-xs-12 col-md-6"><label>Item</label>
                        <select class="form-control" name="ddl_items" id="ddl_items">
                            <option value="0">---SELECT---</option>
                            @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Quantity</label>
                        <input type="text" name="txt_quantity" class="form-control" id="txt_quantity" value="1">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Amount</label>
                        <input type="text" name="txt_amount" class="form-control" id="txt_amount" readonly >
                    </div>
                    <div class="clearfix"></div><br>

                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_save" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageCartsdetails/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_cartDetailsId">
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
<script>
    $(document).ready(function () {
        $('#users').DataTable();
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