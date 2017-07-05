@extends('layouts.admin')
@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Dining Tables</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-danger" data-toggle="modal" data-target="#adddiningTable">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Table Name</th>
                <th>Chair Count</th>
                <th>Table Status</th>
                <th>Section </th>
                <th>Status</th>
                <th>Restuarant </th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($diningtable as $i => $dinning)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$dinning->table_name}}</td>
                    <td>{{$dinning->chairs_count}}</td>
                    <td>{{$dinning->dinningStatus}}</td>
                    <td>{{$dinning->section_name}}</td>
                    @php 
                        $dinningId = encrypt($dinning->id);
                    @endphp
                    <td><p class="label label-success">Status</p></td>
                    <td>{{$dinning->restaurant_name}}</td>
                    <td><a href="{{url('/manageDiningtable/edit/'.$dinningId)}}" class="btn btn-primary">Edit</a></td>
                    <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$dinning->id}}">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="adddiningTable" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form method="post" action="{{url('/manageDiningtable/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Dining Table</h4>
                </div>

                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Table Name</label>
                        <input type="text" name="txt_tableName" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Chair Count</label>
                        <input type="number" name="txt_chairCount"  class="form-control" value="">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="col-xs-12 col-md-6"><label>Status</label>
                        <select class="form-control" name="ddl_dinningStatus">
                            <option value="0">---SELECT---</option>
                            @foreach($dinngStatus as $statusDin)
                                <option value="{{$statusDin->id}}">{{$statusDin->status}}</option>
                            @endforeach
                        </select>
                    </div>
                      
                    <div class="col-xs-12 col-md-6"><label>Section</label>
                        <select class="form-control" name="ddl_section">
                            <option value="0">---SELECT---</option>
                            @foreach($section as $sections)
                                <option  value="{{$sections->id}}">{{$sections->section_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="clearfix"></div><br>
                    <div class="col-xs-12 col-md-6"><label>Restuarant</label>
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
                    <input type="submit" name="btn_saveDinningTable" value="Save" class="btn btn-default">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageDiningtable/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_dinningTableId">
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