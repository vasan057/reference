@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Manage Image Reference</h3>
    <div class="clearfix"></div><br>
    <div class="row"><div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div></div>
    <form action="{{url('/manageImagereference/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$menu->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6">
            <label>Order Date</label>
            <div class="input-group date" id="datetimepicker4" name="txt_orderdate">
                <input type="text" name="ownpurchase_date" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                <span class="input-group-addon testdrivepoint-outer">
                    <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                </span>
            </div>
        </div>
        <div class="col-xs-12 col-md-6"><label>Order Type Id</label>
            <input type="text" name="txt_ordertypeid" class="form-control">
        </div>
        <div class="col-xs-12 col-md-6"><label>Restaurant Id</label>
            <input type="text" name="txt_restaurantid" class="form-control">
        </div>
        <div class="col-xs-12 col-md-6"><label>Customer Id</label>
            <input type="text" name="txt_customerid" class="form-control">
        </div>
        <div class="col-xs-12 col-md-6"><label>Order Status Id</label>
            <input type="text" name="txt_ordstatusid" class="form-control">
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_update" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection