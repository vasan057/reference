@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Dining Table Status</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-danger" data-toggle="modal" data-target="#adddinningstatus">ADD</button> 
    <div class="clearfix"></div><br>

    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Dining Table Status</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dinningTableStatus as $i => $dinnigStatus)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$dinnigStatus->status}}</td>
                @php 
                $dinnigStatusId = encrypt($dinnigStatus->id);
                @endphp
                <td><p class="label label-success">Status</p></td>
                <td><a href="{{url('/manageDinningTableStatus/edit/'.$dinnigStatusId)}}" class="btn btn-primary">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$dinnigStatus->id}}" >Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div id="adddinningstatus" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageDinningTableStatus/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Dinning table Status</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Dining Table Status</label>
                        <input type="text" name="txt_diningstatus" class="form-control">
                    </div>
                </div>
                <div class="clearfix"></div><br>
                <div class="modal-footer">
                    <input type="submit" name="btn_saveDinningTableStatus" value="Save" class="btn btn-default">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageDinningTableStatus/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_dinningStatusId">
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
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
<script type="text/javascript">
    $('#deleteModel').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-body input').val(recipient)
    })
</script>
@endsection