@extends('layouts.admin')

@section('content')
	@if(isset($menu))
		<div class="col-xs-12">
		    <h3>Edit MenuItems</h3>
		    <div class="clearfix"></div><br>
		    <form action="{{url('/manageMenuItems/edit')}}" method="post" enctype="multipart/form-data">
		        <input type="hidden" name="txt_id" value="{{$menu->id}}">
		        {{csrf_field()}}
		        <div class="col-xs-6">
		            <label>Menu Name</label>
		            <input value="{{$menu->item_name}}" type="text" name="txt_item_name" class="form-control" >
		        </div>
		        <div class="col-xs-12 col-md-6">
		            <label>Item Description</label>
		            <textarea class="form-control" name="txtar_item_description">{{$menu->item_description}}</textarea>
		        </div>
		        <div class="col-xs-6">
		            <label>Menu Item Price</label>
		            <input  type="number" name="txt_item_price" class="form-control" value="{{$menu->item_price}}">	
		        </div>
		        <div class="col-xs-12 col-md-6">
		            <label>Item Type</label>
		            <select class="form-control" name="ddl_menuItemType">
		                <option value="0" disabled>---SELECT---</option>
		                <option value="Vegan" <?php if($menu->item_type == "Vegan") echo 'selected="selected"'; ?>>Vegan</option>
				    	<option value="Vegetarian" <?php if($menu->item_type == "Vegetarian") echo 'selected="selected"'; ?>>Vegetarian</option>
				    	<option value="Non-vegetarian" <?php if($menu->item_type == "Non-vegetarian") echo 'selected="selected"'; ?>>Non-vegetarian</option>
		            </select>
		        </div>

		        <div class="clearfix"></div><br>
		        <div class="col-xs-12 col-md-6">
		            <label>Item Image</label>
		            <input type="file" name="fl_menuImage" accept="image/*" class="form-control">
		        </div>
		        <div class="col-xs-12 col-md-3">
		            <div class="checkbox">
						<label>
							<input type="checkbox" name="rb_is_gluten_free" value="1" <?php if($menu->is_gluten_free == "1") echo "checked='checked'"; ?>>Is Gluten Free
						</label>
		            </div>
		        </div>
		        <div class="col-xs-12 col-md-3">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="rb_is_lactose_free" value="1" <?php if($menu->is_lactose_free == "1") echo "checked='checked'"; ?>>Is Lactose Free
						</label>
					</div>
		        </div>
		        <div class="clearfix"></div><br>
		        <div class="col-xs-12 col-md-6">
		            <label>Allergen Info</label>
		            <textarea class="form-control" name="txtar_allergenInfo">{{$menu->allergen_info}}</textarea>
		        </div>
		        <div class="col-xs-12 col-md-6">
		            <label>Item Notes</label>
		            <textarea class="form-control" name="txtar_itemNotes">{{$menu->item_notes}}</textarea>
		        </div>
		        <div class="clearfix"></div><br>
		        <div class="col-xs-12">
		            <input type="submit" name="btn_update" value="Save" class="btn btn-primary">
		        </div>
		    </form>
		</div>
	@endif
@endsection