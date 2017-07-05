@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Dining Table Tracks</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#adddinningtrack">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Dinning Table</th>
                <th>Order</th>
                <th>Order Status</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dining_tableTracks as $i => $track)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$track->table_name}}</td>
                    <td>{{$track->order_date}}</td>
                    @php 
                        $trackId = encrypt($track->id);
                    @endphp
                    <td>{{$track->order_status_desc}}</td>
                    <td><p class="label label-success">Status</p></td>
                    <td><a href="{{url('/manageDiningtabletracks/edit/'.$trackId)}}" class="btn btn-danger">Edit</a></td>
                    <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$track->id}}" class="btn btn-danger">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="adddinningtrack" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageDiningtabletracks/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Dinning table track</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Dinning Table</label>
                        <select class="form-control" name="ddl_DinningTable">
                            <option value="0">---SELECT---</option>
                            @foreach($dining_table as $dinningTable)
                                <option value="{{$dinningTable->id}}">{{$dinningTable->table_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Order Id</label>
                        <select class="form-control" name="ddl_order">
                            <option value="0">---SELECT---</option>
                            @foreach($order as $odrs)
                                <option value="{{$odrs->id}}">{{$odrs->order_date}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Order Status</label>
                        <select class="form-control" name="ddl_OrderStatus">
                            <option value="0">---SELECT---</option>
                            @foreach($orderStatus as $ordrStatus)
                                <option value="{{$ordrStatus->id}}">{{$ordrStatus->order_status_desc}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_saveDinningTrack" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageDiningtabletracks/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_deliveryTrackId">
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
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
@endsection