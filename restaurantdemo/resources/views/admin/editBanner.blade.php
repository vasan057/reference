	

@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
    <h3>Edit Banner</h3>
    <form method="post" action="{{url('/manageBanner/edit')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <input type="hidden" name="txt_id" value="{{$banners->id}}">
        <div class="col-xs-12 col-md-6">
            <label>Banner Name</label>
            <input type="text" name="txt_bannerName" class="form-control" value="{{$banners->banner_name}}">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Banner Description</label>
            <textarea class="form-control" name="txtar_bannerdescription">{{$banners->banner_desc}}</textarea>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Banner Image</label>
            <input type="file" name="fl_bannerpic" accept="image/*">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Menu Items Id</label>
            <select class="form-control" name="ddl_menuitem">
                <option value="0">Select Menu Items</option>
                @foreach($menu_items as $menu)
                	<option value="{{$menu->id}}" <?php if($menu->id == $banners->menu_item_id) echo "selected = 'selected'"; ?>>{{$menu->item_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Display Order</label>
            <input type="number" name="txt_displayorder" class="form-control" value="{{$banners->display_order}}">
        </div>
        <div class="col-xs-12 col-md-6"><label>Banner Type</label>
            <select class="form-control" name="ddl_bannerType">
                <option value="0">---SELECT---</option>
                <option value="Intro Images" <?php if($banners->banner_type == "Intro Images") echo "selected=selected"; ?>>Intro Images</option>
                <option value="Slider Images" <?php if($banners->banner_type == "Slider Images") echo "selected=selected"; ?> >Slider Images</option>
                <option value="Item Images" <?php if($banners->banner_type == "Item Images") echo "selected=selected"; ?> >Item Images</option>
            </select>
        </div>
      
        <div class="col-md-12">
        	<div class="pull-right">
        		<input type="submit" class="btn btn-primary " value="UPDATE" name="btn_updateBanner">
        	</div>
        </div>
    </form>
</div>

@endsection