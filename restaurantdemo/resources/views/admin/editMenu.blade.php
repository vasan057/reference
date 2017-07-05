@extends('layouts.admin')

@section('content')
<div class="col-xs-12">
    <h3>Edit Menu</h3>
    <div class="clearfix"></div><br>
    <form action="{{url('/manageMenu/edit')}}" method="post">
        <input type="hidden" name="txt_id" value="{{$menu->id}}">
        {{csrf_field()}}
        <div class="col-xs-6">
            <label>Menu Name</label>
            <input value="{{$menu->menu_version}}" type="text" name="txt_menuName" class="form-control" >	
        </div>

        <div class="clearfix"></div><br>
        <div class="col-xs-12">
            <input type="submit" name="btn_update" value="Save" class="btn btn-primary">
        </div>
    </form>
</div>
<div class="col-xs-12">
    <h3>Restaurant Menu Items</h3>
    <div class="col-xs-12 col-md-3 pull-right btn-lg"> <button class="btn btn-primary" data-toggle="modal" data-target="#addrestmenu">Add Menu Item</button> </div>
    <table id="users" class="table table-hover table-condensed" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Category</th>
                <th>Item Details</th>
                <th>Display Order</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach($rest_menu_item as $i => $restMenuItem)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$restMenuItem->category_name}}</td>
                    <td><img src="{{url($restMenuItem->image_url)}}" alt="" style="width:30%"/><p>Name1</p></td>
                    <td>1</td>
                    <td><p class="label label-success">status</p></td>
                    <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$restMenuItem->id}}" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        </tbody>

    </table></div>
<div id="addrestmenu" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/managerestaurantMenus')}}" method="post">
             <input type="hidden" name="txt_id" value="{{$menu->id}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Restaurant Menus  </h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Category</label>
                        <select class="form-control" name="ddl_category">
                            <option value="0">---SELECT---</option>
                            @foreach($menu_categories as $menuCat)
                                <option value="{{$menuCat->id}}">{{$menuCat->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="col-xs-12 col-md-6"><label>Item Details</label>
                        <select class="form-control" name="ddl_Itemdetail">
                            <option value="0">---SELECT---</option>
                            @foreach($menu_items as $menuItem)
                                <option value="{{$menuItem->id}}">{{$menuItem->item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <div class="col-xs-12 col-md-6"><label>Display Order</label>
                        <input type="number" name="txt_order" value="1" class="form-control">
                    </div>
                    
                </div>
                <div class="clearfix"></div>
                <br/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Update" name="btn_updateMenuItems">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/managerestaurantMenus/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_restMenuId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="DELETE">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $('#deleteModel').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-body input').val(recipient)
    })
</script>
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
@endsection