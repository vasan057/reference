@extends('layouts.admin')

@section('content')

<div class="col-xs-12">
    <h3>Edit User</h3>
    <br/>
    <div class="row"><div class="col-xs-12 col-md-2 pull-right btn-lg"><p class="label label-success">Status</p></div></div>
    <div class="clearfix"></div>
    <br/>
    <form method="post" action="{{url('/manageUser/edit/'.$restaurant[0]->id)}}">
        {{csrf_field()}}

        <div class="col-xs-12 col-md-6"><label>Name</label>
            <input type="text" name="txt_name" class="form-control">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Email</label>
            <input type="email" name="txt_email" class="form-control">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Password</label>
            <input type="password" name="txt_password" class="form-control">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>Remember Token</label>
            <input type="text" name="txt_rmbtoken" class="form-control">
        </div>
        <div class="col-xs-12 col-md-6">
            <label>User Type Id</label>
            <input type="text" name="txt_usertpeid" class="form-control">
        </div>
        <br>
        <div class="col-md-12"><div class="pull-right"><input type="submit" class="btn btn-primary " value="UPDATE" name="btn_updateRestaurent"></div></div>
    </form>
</div>

@endsection