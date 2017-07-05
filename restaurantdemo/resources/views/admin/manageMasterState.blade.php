@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Master State</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#addstate">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Country Id</th>
                <th>State Name</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($states as $i => $state)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$state->countryName}}</td>
                <td>{{$state->stateName}}</td>
                @php 
                $stateId = encrypt($state->stateId);
                @endphp
                <td><p class="label label-success">Status</p></td>
                <td>{{$state->created_at}}</td>
                <td><a href="{{url('/manageMasterState/edit/'.$stateId)}}" class="btn btn-danger">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$state->stateId}}" >Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addstate" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageMasterState/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Master State</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Country </label>
                        <select name="ddl_country" class="form-control">
                            <option value="0">---SELECT---</option>
                            @foreach($country as $count)
                            <option value="{{$count->id}}">{{$count->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>State Name</label>
                        <input type="text" name="txt_statename" class="form-control">
                    </div>
                    <!-- <div class="col-xs-12 col-md-6">
                        <label>created at</label>
                        <div class="input-group date" id="datetimepicker4" name="txt_createat">
                            <input type="text" name="txt_crtat" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>created at</label>
                        <div class="input-group date" id="datetimepicker4" name="txt_updateat">
                            <input type="text" name="txt_updtat" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div> -->
                    <div class="clearfix"></div><br>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_StateSave" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageMasterState/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_stateId">
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
<script>$('.date').datetimepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        startView: "month",
        minView: "month",
        maxView: "decade"
    });
</script>
@endsection