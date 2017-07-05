@extends('layouts.admin')

@section('content')
<div class="col-xs-12" id="no-more-tables">
    <h3>Edit Customers</h3>
    <div class="clearfix"></div><br>
    <div class="row">
        <div class="col-xs-12 col-md-2 pull-right btn-lg">
            <p class="label label-success">Status</p>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="col-xs-6">
            <div class="col-xs-12">
                <div class="x_panel tile fixed_height_320 overflow_hidden">
                    <div class="x_title">
                        <h2>Device Usage</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="" style="width:100%">
                            <tr>
                                <th style="width:37%;">
                                    <p>Top 5</p>
                                </th>
                                <th>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <p class="">Device</p>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <p class="">Progress</p>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                </td>
                                <td>
                                    <table class="tile_info">
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square blue"></i>IOS </p>
                                            </td>
                                            <td>30%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square green"></i>Android </p>
                                            </td>
                                            <td>10%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square purple"></i>Blackberry </p>
                                            </td>
                                            <td>20%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square aero"></i>Symbian </p>
                                            </td>
                                            <td>15%</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><i class="fa fa-square red"></i>Others </p>
                                            </td>
                                            <td>30%</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div><br>

        </div>
        <div class="col-xs-6">
            <form action="{{url('/manageCustomers/edit')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="txt_id" value="{{$customers->id}}">
                {{csrf_field()}}
                <div class="col-xs-12 col-md-6"><label>Customer Name</label>
                    <input type="text" name="txt_customername" class="form-control" value="{{$customers->customer_name}}">
                </div>

                <div class="col-xs-12 col-md-6"><label>Phone</label>
                    <input type="text" name="txt_phone" class="form-control" value="{{$customers->phone}}">
                </div>
                <div class="clearfix"></div><br>

                <div class="col-xs-12 col-md-6"><label>Landline No 1</label>
                    <input type="text" name="txt_lnd1" class="form-control" value="{{$customers->phone_number_landline_1}}">
                </div>

                <div class="col-xs-12 col-md-6"><label>Landline No 2</label>
                    <input type="text" name="txt_lnd2" class="form-control" value="{{$customers->phone_number_landline_2}}">
                </div>
                <div class="clearfix"></div><br>

                <div class="col-xs-12 col-md-6"><label>Mobile No 1</label>
                    <input type="text" name="txt_mbl1" class="form-control" value="{{$customers->phone_number_mobile_1}}">
                </div>

                <div class="col-xs-12 col-md-6"><label>Mobile No 2</label>
                    <input type="text" name="txt_mbl2" class="form-control" value="{{$customers->phone_number_mobile_2}}">
                </div>
                <div class="clearfix"></div><br>

                <div class="col-xs-12 col-md-6"><label>Mobile No 3</label>
                    <input type="text" name="txt_mbl3" class="form-control" value="{{$customers->phone_number_mobile_3}}">
                </div>

                <div class="col-xs-12 col-md-6"><label>Customer Image</label>
                    <input type="file" name="fl_customerImage" class="form-control" >
                </div>
                <div class="clearfix"></div><br>
                <input type="submit" name="btn_updateCustomer" value="Save" class="btn btn-primary">
            </form>
            <div class="clearfix"></div><br>

        </div>
        <div class="col-xs-12">
            <h4 class="modal-title">Customer Cart</h4>
            <div class="clearfix"></div><br>
            <div class="col-xs-12">
                <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $i => $carts)
                        <tr>
                            <td>{{++$i}}</td>
                            <td><img src="{{url($carts->image_url)}}" class="img-responsive" width="150"/></td>
                            <td>{{$carts->item_name}}</td>
                            <td>{{$carts->item_price}}</td>
                            <td>{{$carts->quanitity}}</td>
                            <td>{{$carts->item_price}}</td>
                            <td><a  data-toggle="modal" data-target="#deleteCartModel" class="btn btn-danger" data-whatever="{{$carts->id}}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <td colspan="4"></td>
                    <!-- <td>Total Cost Rs. 123456</td> -->
                    <td></td>
                    </tfoot>
                </table>
            </div>
            <div class="modal fade" id="deleteCartModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="{{url('/manageCartItems/delete')}}">
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

            <div class="clearfix"></div><br>
            <h4 class="modal-title">Customer Reservation</h4>
            <div class="clearfix"></div><br>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addreservation">Add New Reservation</button> 
            <div class="clearfix"></div><br>
            <div class="col-xs-12">
                <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Reservation Date</th>
                            <th>Dining Table</th>
                            <th>Reservation Status</th>
                            <th>Change Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservation as $i=> $reser)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$reser->reservation_date}}</td>
                            <td>{{$reser->chairs_count}}</td>
                            <td><p class="label label-success">Status</p></td>
                            <td><a href="" class="btn btn-danger">Change Status</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div><br>
            <div id="addreservation" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <form method="post" action="{{url('/manageReservation/add')}}">
                        {{csrf_field()}}
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Reservation</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-xs-12 col-md-6">
                                    <label>Reservation Date</label>
                                    <div class="input-group date" id="datetimepicker4">
                                        <input type="text" name="txt_reservationdate" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                                        <span class="input-group-addon testdrivepoint-outer">
                                            <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6"><label>Customer</label>
                                    <select name="ddl_customer" class="form-control">
                                        <option value="0">---SELECT---</option>
                                        <option value="1">customer_name</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div><br>   
                                <div class="col-xs-12 col-md-6"><label>Dining Table</label>
                                    <select name="ddl_dinningTable" class="form-control">
                                        <option value="0">---SELECT---</option>
                                        <option value="1">chairs_count</option>

                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div><br>   
                            <div class="modal-footer">
                                <input type="submit" name="btn_saveReservation" value="Save" class="btn btn-primary">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h4 class="modal-title">Customer Address</h4>
            <div class="clearfix"></div><br>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addcusadd">Add New Address</button> 
            <div class="clearfix"></div><br>
            <div class="col-xs-12">
                <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Address Type</th>
                            <th>Address</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customerAddress as $i => $custAddr)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$custAddr->address_type_desc}}</td>
                            <td>{{$custAddr->address}}</td>
                            @php
                            $custAddrId = encrypt($custAddr->id);
                            @endphp
                            <td><a href="{{url('/customeraddress/edit/'.$custAddrId)}}" class="btn btn-danger">Edit</a></td>
                            <td><a  data-toggle="modal" data-target="#deleteAddressModel" class="btn btn-danger" data-whatever="{{$customers->id}}">Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div><br>

            <div id="addcusadd" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <form method="post" action="{{url('/customeraddress/add')}}">
                        <input type="hidden" name="txt_id" value="{{$customers->id}}">
                        {{csrf_field()}}
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Customer Address</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-xs-12 col-md-6"><label>Address</label>
                                    <textarea type="text" name="txtar_address" class="form-control"></textarea>
                                </div>
                                <div class="col-xs-12 col-md-6"><label>Address Type</label>
                                    <select name="ddl_addressType" class="form-control">
                                        <option value="0">---SELECT---</option>
                                        @foreach($addressType as $addr)
                                        <option value="{{$addr->id}}">{{$addr->address_type_desc}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="clearfix"></div><br>

                                <div class="col-xs-12 col-md-6"><label>Latitude</label>
                                    <input type="text" name="txt_latitude" class="form-control">
                                </div>
                                <div class="col-xs-12 col-md-6"><label>Logitude</label>
                                    <input type="text" name="txt_logitude" class="form-control">
                                </div>
                                <div class="clearfix"></div><br>  

                                <div class="col-xs-12 col-md-6"><label>City</label>
                                    <select name="ddl_city" class="form-control">
                                        <option value="0">---SELECT---</option>
                                        @foreach($city as $cities)
                                        <option value="{{$cities->id}}">{{$cities->city_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div><br>
                            <div class="modal-footer">
                                <input type="submit" name="btn_saveCustomerAddress" value="Save" class="btn btn-primary">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="deleteAddressModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="{{url('/customeraddress/delete')}}">
                            {{csrf_field()}}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                                    <input type="hidden" class="form-control" id="recipient-name" name="txt_customerId">
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

            <h4 class="modal-title">Customer Order</h4>
            <div class="clearfix"></div><br>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addorder">Add New Order</button> 
            <div class="clearfix"></div><br>
            <div class="col-xs-12">
                <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Order Date</th>
                            <th>Food Name</th>
                            <th>Order Status</th>
                            <th>No Of Items</th>
                            <th>Amount</th>
                            <!-- <th>Edit</th>
                            <th>Delete</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customerOrders as $i => $custOrdr)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$custOrdr->created_at}}</td>
                            <td>{{$custOrdr->item_name}}</td>
                            <td><p class="label label-success">Status</p></td>
                            <td>{{$custOrdr->item_quanitity}}</td>
                            <td>
                                <?php $TotalPrice = ($custOrdr->item_quantitiy) * ($custOrdr->item_price); ?>
                                {{$TotalPrice}}
                            </td>
                        <!-- <td><a href="" class="btn btn-danger">Edit</a></td>
                        <td><a  data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$customers->id}}">Delete</a></td> -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="addorder" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <form method="post" action="{{url('/manageOrders/add')}}">
                        {{csrf_field()}}
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Order</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-xs-12 col-md-6">
                                    <label>Order Date</label>
                                    <div class="input-group date" id="datetimepicker4" name="txt_orderdate">
                                        <input type="text" name="txt_orddate" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                                        <span class="input-group-addon testdrivepoint-outer">
                                            <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label>Order Type</label>
                                    <select class="form-control" name="ddl_ordertype">
                                        <option value="0">---SELECT</option>
                                        <option value="1">order_type</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-6"><label>Customer Name</label>
                                    <select class="form-control" name="ddl_cusname" id="ddl_cusname">
                                        <option value="0">---SELECT---</option>
                                        <option value="1">customer_name</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-6"><label>Customer Address</label>
                                    <select class="form-control" name="ddl_cusaddress" id="ddl_cusaddress">
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label>Restaurant Name</label>
                                    <select class="form-control" name="ddl_restname">
                                        <option value="0">---SELECT---</option>
                                        <option value="1">restaurant_name</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-md-6"><label>Order Status</label>
                                    <select class="form-control" name="ddl_ordestatus">
                                        <option value="0">---SELECT---</option>
                                        <option value="1">order_status</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="btn_saveOrder" value="Save" class="btn btn-primary">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script type="text/javascript">
        $('#deleteCartModel').on('show.bs.modal', function (event)
        {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
            modal.find('.modal-body input').val(recipient)
        })
    </script>
    <script type="text/javascript">
        $('#deleteAddressModel').on('show.bs.modal', function (event)
        {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
            modal.find('.modal-body input').val(recipient)
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>
    @endsection