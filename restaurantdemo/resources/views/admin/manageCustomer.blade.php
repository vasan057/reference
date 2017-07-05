@extends('layouts.admin')
@section('content')
<div class="col-xs-12" id="no-more-tables">
    <h3>Customer</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#addcustomer">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover display table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Cutomer Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Email</th>
                <th>Reset Password</th>
                <th>Number of Address</th>
                <th>Number of Items in Cart</th>
                <th>Active Carts</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $i => $customer)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$customer->customer_name}}</td>
                <td>{{$customer->phone}}</td>
                @php 
                $customerId = encrypt($customer->id);
                @endphp
                <td><p class="label label-success">Status</p></td>
                <td>{{$customer->email}}</td>
                <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#resetpwd">Reset Password</button>
                </td>
                <td>
                    <label>{{$customer->customerAddrCount}}</label>
                </td>
                <td>
                    <label>{{$customer->customerCartCount1}}</label>
                </td>
                <td>
                    <label>0</label>
                </td>
                <td>
                    <a href="{{url('/manageCustomers/edit/'.$customerId)}}" class="btn btn-danger">Edit</a>
                </td>
                <td>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$customer->id}}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addcustomer" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageCustomers/add')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Customer</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body row">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details"  data-toggle="tab" aria-expanded="false">Add Image</a></li>
                            <li ><a href="#documents" data-toggle="tab" aria-expanded="true">View</a></li>
                        </ul>
                        <br>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="details">
                                <div class="col-xs-12 card">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 col-xs-12  text-center">
                                            <div class="addimage text-center">
                                                <div class="form-group">
                                                    <div>
                                                        <img src="img/addimage.png" class="image">
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="">
                                                <p class="btn btn-sm btn-primary"><i class="fa fa-cloud-upload"></i> Select your file from computer</p>
                                                <span class="upload_btn"></span>
                                                <input name="fl_customerImage" class="doc-msg" id="profile_image" type="file">
                                            </div>
                                        </div>
                                    </div>                                                
                                </div>
                            </div>
                            <div class="tab-pane fade" id="documents">
                                <div  class="card">
                                    <div class="col-md-12 file-select">
                                        <div class="col-md-2"><input class="select-img" type="checkbox"> </div>
                                        <div class="col-md-4"><img src="img/hot1.jpg" alt=""/></div>
                                        <div class="col-md-4">Image name</div>
                                    </div>
                                    <div class="col-md-12 file-select">
                                        <div class="col-md-2"><input class="select-img" type="checkbox"> </div>
                                        <div class="col-md-4"><img src="img/hot2.jpg" alt=""/></div>
                                        <div class="col-md-4">Image name</div>
                                    </div>
                                    <div class="col-md-12 file-select">
                                        <div class="col-md-2"><input class="select-img" type="checkbox"> </div>
                                        <div class="col-md-4"><img src="img/hot3.jpg" alt=""/></div>
                                        <div class="col-md-4">Image name</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12"><ul class="pagination pagination-sm">
                                                <li><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#">5</a></li>
                                            </ul>
                                            <button type="submit" class="pagination btn btn-primary btn-sm col-sm-3 col-md-2 pull-right">Save</button>
                                        </div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Customer Name</label>
                        <input type="text" name="txt_customername" class="form-control">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Phone</label>
                        <input type="text" name="txt_phone" class="form-control">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Email</label>
                        <input type="email" name="txt_email" class="form-control">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>password</label>
                        <input type="password" name="txt_password" class="form-control">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Landline No 1</label>
                        <input type="text" name="txt_lnd1" class="form-control">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Landline No 2</label>
                        <input type="text" name="txt_lnd2" class="form-control">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Mobile No 1</label>
                        <input type="text" name="txt_mbl1" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Mobile No 2</label>
                        <input type="text" name="txt_mbl2" class="form-control">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Mobile No 3</label>
                        <input type="text" name="txt_mbl3" class="form-control">
                    </div>

<!--                    <div class="col-xs-12 col-md-6"><label>Image</label>
                        <input type="file" name="fl_customerImage" class="form-control">
                    </div>-->
                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_saveCustomer" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="resetpwd" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageCustomers/resetPassword')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reset Password</h4>
                </div>
                <div class="modal-body">
                    <h5>Are you sure you want to reset the password and send an email to the customer? </h5>
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
            <form method="post" action="{{url('/manageCustomers/delete')}}">
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