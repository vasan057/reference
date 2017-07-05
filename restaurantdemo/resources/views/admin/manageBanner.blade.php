@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Banners</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#addbanner">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Banner Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Menu Item</th>
                <th>Status</th>
                <th>Display Order</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banner as $i => $banners)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$banners->banner_name}}</td>
                <td>{{$banners->banner_desc }}</td>
                <td><img src="{{$banners->image_url}}" width="150"></td>
                <td>{{$banners->item_name}}</td>
                <td><p class="label label-success">Status</p></td>
                <td>{{$banners->display_order}}</td>
                @php
                $menuId = encrypt($banners->bannerId);
                @endphp
                <td><a href="{{url('/manageBanner/edit/'.$menuId)}}" class="btn btn-danger">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$banners->bannerId}}" >Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="addbanner" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/manageBanner/add')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Banner</h4>
                </div>
                <div class="modal-body">
                    <div class="panel-body row">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#details"  data-toggle="tab" aria-expanded="false">Add Image</a></li>
                            <li ><a href="#documents" data-toggle="tab" aria-expanded="true">View</a></li>
                        </ul>
                        <br>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="details">
                                <div class="col-xs-12 card">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 col-xs-12  text-center">
                                            <div class="addimage text-center">
                                                <div class="form-group">
                                                    <div>
                                                        <img src="img/addimage.png" class="image">
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="">
                                                <p class="btn btn-sm btn-primary"><i class="fa fa-cloud-upload"></i> Select your file from computer</p>
                                                <span class="upload_btn"></span>
                                                <input name="fl_bannerimage" class="doc-msg" id="profile_image" type="file">
                                            </div>
                                        </div>
                                    </div>                                                
                                </div>
                            </div>
                            <div class="tab-pane fade" id="documents">
                                <div  class="card">
                                    <div class="col-md-12 file-select">
                                        <div class="col-md-2"><input class="select-img" type="checkbox"> </div>
                                        <div class="col-md-4"><img src="img/hot1.jpg" alt=""/></div>
                                        <div class="col-md-4">Image name</div>
                                    </div>
                                    <div class="col-md-12 file-select">
                                        <div class="col-md-2"><input class="select-img" type="checkbox"> </div>
                                        <div class="col-md-4"><img src="img/hot2.jpg" alt=""/></div>
                                        <div class="col-md-4">Image name</div>
                                    </div>
                                    <div class="col-md-12 file-select">
                                        <div class="col-md-2"><input class="select-img" type="checkbox"> </div>
                                        <div class="col-md-4"><img src="img/hot3.jpg" alt=""/></div>
                                        <div class="col-md-4">Image name</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12"><ul class="pagination pagination-sm">
                                                <li><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#">5</a></li>
                                            </ul>
                                            <button type="submit" class="pagination btn btn-primary btn-sm col-sm-3 col-md-2 pull-right">Save</button>
                                        </div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Banner Name</label>
                        <input type="text" name="txt_bannerName" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Banner Description</label>
                        <textarea class="form-control" name="txtar_bannerdescription"></textarea>
                    </div>
<!--                    <div class="col-xs-12 col-md-6">
                        <label>Image</label>
                        <input type="file" name="fl_bannerimage" class="form-control">
                    </div>-->
                    <div class="col-xs-12 col-md-6">
                        <label>Menu Item Id</label>
                        <select class="form-control" name="ddl_menuitem">
                            <option value="0">---SELECT---</option>
                            @foreach($menu_items as $menu)
                            <option value="{{$menu->id}}">{{$menu->item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Display Order</label>
                        <input type="number" name="txt_displayorder" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Banner Type</label>
                        <select class="form-control" name="ddl_bannerType">
                            <option value="0">---SELECT---</option>
                            <option value="Intro Images">Intro Images</option>
                            <option value="Slider Images">Slider Images</option>
                            <option value="Item Images">Item Images</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_saveBanner">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageBanner/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_bannerId">
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