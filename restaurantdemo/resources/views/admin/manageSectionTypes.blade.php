@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Manage Section Types</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#addsectiontype">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Section Type</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($section_type as $i => $section)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$section->section_type}}</td>
                @php 
                $sectionId = encrypt($section->id);
                @endphp
                <td><p class="label label-success">Status</p></td>

                <td><a href="{{url('/manageSectiontypes/edit/'.$sectionId)}}" class="btn btn-danger">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$section->id}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addsectiontype" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageSectiontypes/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Section Type</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Section Type</label>
                        <input type="text" name="txt_sectiontype" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_saveSectionType" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageSectiontypes/delete')}}">
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