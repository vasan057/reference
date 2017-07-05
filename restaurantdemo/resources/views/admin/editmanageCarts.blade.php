@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Carts</h3>
    <div class="clearfix"></div><br>
    <div class="row"><div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div></div>
    <form action="{{url('/manageCarts/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$cart->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6"><label>Cart Name</label>
            <input type="text" name="txt_cartname" class="form-control" value="{{$cart->cart_name}}">
        </div>
        <div class="clearfix"></div><br>

        <div class="col-xs-12 col-md-6"><label>Customer Id</label>
            <select name="ddl_customer" class="form-control">
                <option value="0">---SELECT---</option>
                @foreach($customer as $cust)
                    <option value="{{$cust->id}}" <?php if($cust->id == $cart->customers_id) echo "selected='selected'"; ?>>{{$cust->customer_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_update" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection