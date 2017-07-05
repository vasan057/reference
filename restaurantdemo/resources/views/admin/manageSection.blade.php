@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Manage Section</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-danger" data-toggle="modal" data-target="#addsection">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Section Name</th>
                <th>Section Type</th>
                <th>Section Property </th>
                <th>Status</th>
                <th>Restaurant</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($section as $i => $sections)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$sections->section_name}}</td>
                <td>{{$sections->section_type}}</td>
                @php 
                $sectionsId = encrypt($sections->id);
                @endphp
                <td>{{$sections->section_property_name}}</td>
                <td><p class="label label-success">Status</p></td>
                <td>{{$sections->restaurant_name}}</td>
                <td><a href="{{url('/manageSection/edit/'.$sectionsId)}}" class="btn btn-primary">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$sections->id}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addsection" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageSection/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Section</h4>
                </div>
                <div class="modal-body">

                    <div class="col-xs-12 col-md-6"><label>Section Name</label>
                        <input type="text" name="txt_sectionname" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Section Type</label>
                        <select name="ddl_sectionType" class="form-control">
                            <option value="0">---SELECT----</option>
                            @foreach($sectionType as $sectiontype)
                            <option value="{{$sectiontype->id}}">{{$sectiontype->section_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Section Property</label>
                        <select class="form-control" name="ddl_sectionProperty">
                            <option value="0">---SELECT---</option>
                            @foreach($sectionPrpty as $sctionPrpty)
                            <option value="{{$sctionPrpty->id}}">{{$sctionPrpty->section_property_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Restaurant</label>
                        <select class="form-control" name="ddl_restaurant">
                            <option value="0">---SELECT---</option>
                            @foreach($restaurant as $rest)
                            <option value="{{$rest->id}}">{{$rest->restaurant_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="clearfix"></div><br> 
                <div class="modal-footer">
                    <input type="submit" name="btn_saveSection" value="Save" class="btn btn-default">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageSection/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_sectionId">
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