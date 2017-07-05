@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Customer Address</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#addcusadd">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Address Type</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Status</th>
                <th>City</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $i => $customer)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$customer->customer_name}}</td>
                <td>{{$customer->address}}</td>
                @php 
                $customerId = encrypt($customer->id);
                @endphp
                <td>{{$customer->address_type_desc}}</td>
                <td>{{$customer->latitude}}</td>
                <td>{{$customer->longitude}}</td>
                <td><p class="label label-success">Status</p></td>
                <td>{{$customer->city_name}}</td>
                <td><a href="{{url('/customeraddress/edit/'.$customerId)}}" class="btn btn-danger">Edit</a></td>
                <td><a href="{{url('/customeraddress/delete/'.$customerId)}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addcusadd" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/customeraddress/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Customer Address</h4>
                </div>
                <div class="modal-body">

                    <div class="col-xs-12 col-md-6"><label>Cutomer</label>
                        <select class="form-control" name="ddl_customer">
                            <option value="0">---SELECT---</option>
                            @foreach($customers as $cust)
                            <option value="{{$cust->id}}">{{$cust->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Address</label>
                        <textarea type="text" name="txtar_address" class="form-control"></textarea>
                    </div>
                    <div class="clearfix"></div><br>  
                    <div class="col-xs-12 col-md-6"><label>Address Type</label>
                        <select name="ddl_addressType" class="form-control">
                            <option value="0">---SELECT---</option>
                            @foreach($addressType as $addr)
                            <option value="{{$addr->id}}">{{$addr->address_type_desc}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Latitude</label>
                        <input type="text" name="txt_latitude" class="form-control">
                    </div>
                    <div class="clearfix"></div><br>  
                    <div class="col-xs-12 col-md-6"><label>Logitude</label>
                        <input type="text" name="txt_logitude" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>City</label>
                        <select name="ddl_city" class="form-control">
                            <option value="0">---SELECT---</option>
                            @foreach($city as $cities)
                            <option value="{{$cities->id}}">{{$cities->city_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_saveCustomer" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
@endsection