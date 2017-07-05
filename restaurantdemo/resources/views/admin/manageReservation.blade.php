@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
    <h3>Reservation</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-danger" data-toggle="modal" data-target="#addorder">ADD</button> 
    <div class="clearfix"></div><br>
    <div  id="no-more-tables" class="col-xs-12" >
        <table id="users" class="display table table-striped table-bordered table-hover datable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Reservation Date</th>
                    <th>Customer </th>
                    <th>Dining Table </th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservation as $i => $resrvtion)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$resrvtion->reservation_date}}</td>
                    <td>{{$resrvtion->customer_name}}</td>
                    <td>{{$resrvtion->chairs_count}}</td>
                    @php 
                        $resrvtionId = encrypt($resrvtion->id);
                    @endphp
                    <td><p class="label label-success">Status</p></td>
                    <td><a href="{{url('/manageReservation/edit/'.$resrvtionId)}}" class="btn btn-primary">Edit</a></td>
                    <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$resrvtion->id}}" class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="addorder" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageReservation/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Reservation</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Reservation Date</label>
                        <div class="input-group date" id="datetimepicker4">
                            <input type="text" name="txt_reservationdate" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Customer</label>
                        <select name="ddl_customer" class="form-control">
                            <option value="0">---SELECT---</option>
                            @foreach($customer as $cust)
                                <option value="{{$cust->id}}">{{$cust->customer_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="clearfix"></div><br>   
                    <div class="col-xs-12 col-md-6"><label>Dining Table</label>
                        <select name="ddl_dinningTable" class="form-control">
                            <option value="0">---SELECT---</option>
                            @foreach($dinningTable as $dinning)
                                <option value="{{$dinning->id}}">{{$dinning->chairs_count}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div><br>   
                <div class="modal-footer">
                    <input type="submit" name="btn_saveReservation" value="Save" class="btn btn-default">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageReservation/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                      <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_reservationId">
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
 $(function () {
    $('#datetimepicker4').datetimepicker();
});
</script>
@endsection