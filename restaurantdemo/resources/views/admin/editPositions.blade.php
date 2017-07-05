@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Position</h3>
    <div class="clearfix"></div><br>
    <form action="{{url('/managePositions/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$getData->id}}">
        {{csrf_field()}}
        <div class="col-xs-6">
            <label>Position Name</label>
            <input value="{{$getData->position_title}}" type="text" name="txt_positionName" class="form-control" >
        </div>
        <div class="clearfix"></div><br>
        <div class="col-xs-12">
            <input type="submit" name="btn_update" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection