@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Dining Table</h3>
    <div class="clearfix"></div><br>
    <div class="row"><div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div></div>
    <form action="{{url('/manageDiningtable/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$dinning->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6">
            <label>Table Name</label>
            <input type="text" name="txt_tableName"  class="form-control" value="{{$dinning->table_name}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Chair Count</label>
            <input type="text" name="txt_chairCount"  class="form-control" value="{{$dinning->chairs_count}}">
        </div>
        <div class="col-xs-12 col-md-6"><label>Status</label>
            <select class="form-control" name="ddl_dinningStatus">
                <option value="0">---SELECT---</option>
                @foreach($dinngStatus as $statusDin)
                <option value="{{$statusDin->id}}" <?php if ($statusDin->id == $dinning->status_id) echo "selected = 'selected'"; ?>>{{$statusDin->status}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6"><label>Section</label>
            <select class="form-control" name="ddl_section">
                <option value="0">---SELECT---</option>
                @foreach($section as $sections)
                <option  value="{{$sections->id}}" <?php if ($sections->id == $dinning->section_id) echo "selected='selected'"; ?>>{{$sections->section_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6"><label>Restuarant</label>
            <select class="form-control" name="ddl_restaurant">
                <option value="0">---SELECT---</option>
                @foreach($restaurant as $rest)
                <option value="{{$rest->id}}" <?php if ($rest->id == $dinning->restaurant_id) echo "selected='selected'"; ?>>{{$rest->restaurant_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_updateDinningTable" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection