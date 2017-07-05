@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Manage Section Properties</h3>
    <div class="clearfix"></div><br>
    <div class="row"><div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div></div>

    <form action="{{url('/manageSectionProperties/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$sectionprpty->id}}">
        {{csrf_field()}}
        <div class="col-xs-12 col-md-6"><label>Section Proprty Name</label>
            <input type="text" name="txt_secpropname" class="form-control" value="{{$sectionprpty->section_property_name}}">
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">

            <input type="submit" name="btn_updateSection" value="UPDATE" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection