@extends('layouts.admin')

@section('content')
<div class="col-xs-12" id="no-more-tables">
    <h3>Positions</h3>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addPositions">ADD</button>
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Positons</th>
                <th>status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($position as $i => $posi)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$posi->position_title}}</td>
                @php
                $positionId = encrypt($posi->id);
                @endphp
                <td><p class="label label-success">Status</p></td>
                <td><a href="" data-toggle="modal" data-target="#editPositions" class="btn btn-danger" id="{{$posi->id}}" >Edit</a></td>
                <td><a href="{{url('/managePositions/delete/'.$positionId)}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addPositions" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/managePositions/Add')}}" method="post">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Positons</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Position Title</label>
                        <input type="text" name="position_title" class="form-control">
                    </div>
                </div>
                <div class="clearfix"></div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_savePosition">
                </div>
            </div>
        </form>
    </div>
</div>
<div id="editPositions" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{url('/managePositions/Add')}}" method="post">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Positons</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Position Title</label>
                        <input type="text" name="position_title" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Status</label>
                        <select class="form-control" name="position_status">
                            <option value="0">Select Status</option>
                            <option value="1">Status</option>
                            <option value="2">Status</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_savePosition">
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