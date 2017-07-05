@extends('layouts.admin')
@section('content')

<div class="col-xs-12"  id="no-more-tables">
    <h3>Manage Image Reference</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#addcart">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Image Name</th>
                <th>Image Description</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rest_menu as $i => $menu)
            <tr>
                <td>{{++$i}}</td>
                <td><img src="../../../public/img/muttonnallicops.jpg" width="150" class="img-responsive"/></td>
                <td>Image Name</td>
                <td>Image Description</td>
                @php 
                $menuId = encrypt($menu->id);
                @endphp
                <td><p class="label label-success">Status</p></td>
                <td><a href="{{url('/manageImagerefernce/delete/'.$menuId)}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addcart" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageImagerefernce/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Image</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Cart Name</label>
                        <input type="file" name="txt_pic" class="form-control">
                    </div>
                </div>
                <div class="clearfix"></div><br> 
                <div class="modal-footer">
                    <input type="submit" name="btn_save" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
@endsection