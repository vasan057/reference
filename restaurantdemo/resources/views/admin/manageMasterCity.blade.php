@extends('layouts.admin')

@section('content')

<div class="col-xs-12" id="no-more-tables">
    <h3>Master City</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#addmenu">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>State Id</th>
                <th>City Name</th>
                <th>Popular Status</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($city as $i => $cities)
            <tr>
                <td>{{++$i}}</td>
                <td>{{$cities->state_name}}</td>
                <td>{{$cities->city_name}}</td>
                @php 
                $cityId = encrypt($cities->cityId);
                @endphp
                <td>
                    @if($cities->popular_status == "1")
                    POPULAR
                    @else
                    NON-POPULAR
                    @endif
                </td>
                <td><p class="label label-success">Status</p></td>
                <td>{{$cities->created_at}}</td>
                <td><a href="{{url('/manageMasterCity/edit/'.$cityId)}}" class="btn btn-danger">Edit</a></td>
                <td><a  data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="{{$cities->cityId}}" class="btn btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="addmenu" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{url('/manageMasterCity/add')}}">
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Master City</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Country</label>
                        <select class="form-control" name="ddl_country" id="ddl_country">
                            <option value="0">---SELECT---</option>
                            @foreach($country as $count)
                            <option value="{{$count->id}}">{{$count->country_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>State</label>
                        <select name="ddl_state" id="ddl_state" class="form-control"></select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>City Name</label>
                        <input type="text" name="txt_cityname" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Popular Status</label>
                        <select name="ddl_popularStatus" class="form-control">
                            <option value="-1">---SELECT---</option>
                            <option value="1">POPULAR</option>
                            <option value="0">NON-POPULAR</option>
                        </select>
                    </div>
                    <!-- <div class="col-xs-12 col-md-6">
                       <label>created at</label>
                       <div class="input-group date" id="datetimepicker4" name="txt_createdate">
                           <input type="text" name="txt_crtat" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                           <span class="input-group-addon testdrivepoint-outer">
                               <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                           </span>
                       </div>
                   </div> -->
                    <!-- <div class="col-xs-12 col-md-6">
                       <label>Updated at</label>
                       <div class="input-group date" id="datetimepicker4" name="txt_updatedate">
                           <input type="text" name="txt_uptat" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                           <span class="input-group-addon testdrivepoint-outer">
                               <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                           </span>
                       </div>
                   </div> -->

                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_saveCity" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('/manageMasterCity/delete')}}">
                {{csrf_field()}}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_cityId">
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
    $(function () {
        $("#ddl_country").change(function () {
            var countryId = $(this).val();
            token = "{{ csrf_token() }}";
            $.ajax({
                type: "GET",
                url: "{{url('getState')}}?country_id=" + countryId,
                success: function (res)
                {
                    //console.log(res);
                    $("#ddl_state").empty();
                    $("#ddl_state").append('<option value="0">---SELECT---</option>');
                    $.each(res, function (key, value)
                    {
                        $("#ddl_state").append('<option value="' + value.id + '">' + value.state_name + '</option>');
                    });
                }
            });
        });
    });
</script>
<script>
    $('.date').datetimepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        startView: "month",
        minView: "month",
        maxView: "decade"
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
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
@endsection