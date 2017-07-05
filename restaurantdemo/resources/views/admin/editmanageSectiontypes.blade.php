@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Manage Section Types</h3>
    <div class="clearfix"></div><br>
    <div class="row"><div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div></div>
    <form action="{{url('/manageSectiontypes/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$section->id}}">
        {{csrf_field()}}
            <div class="col-xs-12 col-md-6"><label>Section Type</label>
                <input type="text" name="txt_sectiontype" class="form-control" value="{{$section->section_type}}">
            </div>
            <div class="clearfix"></div><br>
            <input type="submit" name="btn_updateSection" value="update" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection