@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Dining Table Tracks</h3>
    <div class="clearfix"></div><br>
    <div class="row">
        <div class="col-xs-12 col-md-2 pull-right btn-lg">
            <p class="label label-success">Status</p>
        </div>
    </div>
    <form action="{{url('/manageDiningtabletracks/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$dinningTableTrack->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6">
            <label>Dinning Table</label>
            <select class="form-control" name="ddl_DinningTable">
                <option value="0">---SELECT---</option>
                @foreach($dining_table as $dinningTable)
                    <option value="{{$dinningTable->id}}" <?php if($dinningTable->id == $dinningTableTrack->dining_table_id)echo "selected = 'selected'"; ?>>{{$dinningTable->table_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6"><label>Order</label>
            <select class="form-control" name="ddl_order">
                <option value="0">---SELECT---</option>
                @foreach($order as $odrs)
                    <option value="{{$odrs->id}}" <?php if($odrs->id == $dinningTableTrack->order_id)echo "selected='selected'"; ?>>{{$odrs->order_date}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6"><label>Order Status</label>
            <select class="form-control" name="ddl_OrderStatus">
                <option value="0">---SELECT---</option>
                @foreach($orderStatus as $ordrStatus)
                    <option value="{{$ordrStatus->id}}" <?php if($ordrStatus->id == $dinningTableTrack->order_status_id)echo "selected='selected'"; ?>>{{$ordrStatus->order_status_desc}}</option>
                @endforeach
            </select>
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_updateDinningTrack" value="Update" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection