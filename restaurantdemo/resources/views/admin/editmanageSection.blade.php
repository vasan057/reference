@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Manage Section</h3>
    <div class="clearfix"></div><br>
    <div class="row">
        <div class="col-xs-12 col-md-2 pull-right btn-lg">
            <p class="label label-success">Status</p>
        </div>
    </div>

    <form action="{{url('/manageSection/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$section->id}}">
        {{csrf_field()}}
         <div class="col-xs-12 col-md-6"><label>Section Name</label>
            <input type="text" name="txt_sectionname" class="form-control" value="{{$section->section_name}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Section Type</label>
            <select name="ddl_sectionType" class="form-control">
                <option value="0">---SELECT----</option>
                @foreach($sectionType as $sectiontype)
                    <option value="{{$sectiontype->id}}"<?php if($sectiontype->id == $section->section_type_id) echo"selected='selected'" ?>>{{$sectiontype->section_type}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Section Property</label>
            <select class="form-control" name="ddl_sectionProperty">
                <option value="0">---SELECT---</option>
                @foreach($sectionPrpty as $sctionPrpty)
                    <option value="{{$sctionPrpty->id}}" <?php if($sctionPrpty->id == $section->section_property_id) echo "selected='selected'"; ?>>{{$sctionPrpty->section_property_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Restaurant</label>
            <select class="form-control" name="ddl_restaurant">
                <option value="0">---SELECT---</option>
                @foreach($restaurant as $rest)
                    <option value="{{$rest->id}}" <?php if($rest->id == $section->restaurant_id) echo "selected='selected'"; ?>>{{$rest->restaurant_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_updateSection" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection