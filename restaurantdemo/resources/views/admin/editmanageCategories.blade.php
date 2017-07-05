@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit MenuCategories</h3>
    <div class="pull-right btn-lg"><p class="label label-success">Status</p></div>

    <div class="clearfix"></div><br>
    <form action="{{url('/manageCategories/edit')}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="txt_id" value="{{$menu->id}}">
        {{csrf_field()}}
        <div class="col-xs-6">
            <label>Category Name</label>
            <input type="text" name="txt_categorieName" class="form-control" value="{{$menu->category_name}}">	
        </div>
        <div class="clearfix"></div><br>

        <div class="col-xs-6">
            <label>Description</label>
            <textarea class="form-control" name="txtar_categorieDescription">{{$menu->description}}</textarea>
        </div>
        <div class="clearfix"></div><br>

        <div class="col-xs-6">
            <label>Image</label>
            <input type="file" name="fl_categoryImage" class="form-control">
        </div>
        <div class="clearfix"></div><br>

        <div class="col-xs-12">

            <input type="submit" name="btn_updateCategory" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection