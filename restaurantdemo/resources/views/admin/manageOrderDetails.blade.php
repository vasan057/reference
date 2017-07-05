@extends('layouts.admin')

@section('content')

<div class="col-xs-12"  id="no-more-tables">
    <h3>Order Details</h3>
    <div class="clearfix"></div>
    <br>
    <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#addOrderdetails">ADD</button>
    <div class="clearfix"></div>
    <br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
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
            @foreach($restaurant as $i => $rest)
            <tr>
                <td>{{++$i}}</td>
                <td><img src="{{URL::asset('img/hot2.jpg')}}" alt="" style="width:30%"/></td>

                <td>Name1</td>
                <td><input type="number" class="form-control" value="1" /></td>
                <td></td>
                <td><p class="label label-success">Status</p></td>
                <td><a href="#" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="addOrderdetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/manageOrdersdetails')}}" method="post">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Order Details  </h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Item Id</label>
                        <input type="text" name="txt_itemId" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Item Quantity</label>
                        <input type="text" name="txt_itemQuantity" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <div class="col-xs-12 col-md-6"><label>Amount</label>
                        <input type="text" name="txt_amount" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Order Id</label>
                        <input type="text" name="txt_orderId" class="form-control">
                    </div>
                </div>
                <div class="clearfix"></div>
                <br/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_saveRestaurant">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection