@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Manage Coupons</h3><br>
    <div class="clearfix"></div>
    <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#addCoupon">ADD</button>
    <br>
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Coupon Code</th>
                <th>Coupon Validity</th>
                <th>Coupon Start Date</th>
                <th>Coupon End Date</th>
                <th>Coupon Amount</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coupon as $i => $coupons)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$coupons->coupon_code}}</td>
                <td>
                    @if($coupons->coupon_validity == "1") 
                    Invalid
                    @else
                    Valid
                    @endif
                </td>
                <td>{{$coupons->coupon_start_date}}</td>
                <td>{{$coupons->coupon_end_date}}</td>
                <td>{{$coupons->coupon_amount}}</td>
                <td><p class="label label-success">Status</p></td>
                @php
                $couponId = encrypt($coupons->coupon_id);
                @endphp
                <td><a href="{{url('manageCoupon/edit/'.$couponId)}}" class="btn btn-danger">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$coupons->coupon_id}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="addCoupon" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/manageCoupon')}}" method="post">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Coupon</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Coupon Code</label>
                        <input type="text" name="txt_couponcode" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Coupon Validity</label>
                        <select class="form-control" name="ddl_couponvalidity">
                            <option value="0">---SELECT---</option>
                            <option value="1">Invalid</option>
                            <option value="2">Valid</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Coupon Start Date</label>
                        <div class="input-group date" id="datetimepicker4" name="txt_couponsdate">
                            <input type="text" name="txt_coupon_start_date" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Coupon End Date</label>
                        <div class="input-group date" id="datetimepicker4" name="txt_couponedate">
                            <input type="text" name="txt_coupon_end_date" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Coupon Amount</label>
                        <input type="text" name="txt_couponamt" class="form-control">
                    </div>

                    <div class="col-xs-12 col-md-6"><label>Coupon Max Usage</label>
                        <input type="text" name="txt_couponmxusg" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Coupon Min Order Amount</label>
                        <input type="text" name="txt_couponmnordamnt" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Coupon Description</label>
                        <textarea name="txtar_coupondes" class="form-control"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Coupon Visiblity</label>
                        <select class="form-control" name="ddl_couponvisibility">
                            <option value="0">---SELECT---</option>
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_saveCoupon">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageCoupon/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_couponId">
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
    $('.date').datetimepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        startView: "month",
        minView: "month",
        maxView: "decade"
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
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
@endsection