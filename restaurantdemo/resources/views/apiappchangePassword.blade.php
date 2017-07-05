<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant</title>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bootstrap/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('font-awesome/css/font-awesome.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/local.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/dataTables.bootstrap.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/custom.min.css')}}">
        <script type="text/javascript" src="{{ URL::asset('js/jquery-1.10.2.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- you need to include the shieldui css and js assets in order for the charts to work -->
        <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
        <link id="gridcss" rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/dark-bootstrap/all.min.css" />
        <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
        <script type="text/javascript" src="http://www.prepbootstrap.com/Content/js/gridData.js"></script>
        @yield('styles')
        <script>
            window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
            ]) !!}
            ;
        </script>
    </head>
    <body>
    @if (count($errors) >= 1)
            <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                @foreach ($errors->all() as $error)
                    {{ $error ." "."Required"}}
                @endforeach                                
            </div>
        @endif
        <div class="col-xs-8 col-xs-offset-2">
            <h3>Change Password</h3>
            <div class="clearfix"></div><br>
            <form method="post" action="{{url('doChangeforgetnewPassword')}}">
                <label>New Password</label>
                <input type="password" name="newPassword" class="form-control">
                <div class="clearfix"></div><br>
                <span><input type="hidden" name="customerid" value="{{($custid ==! '')?$custid:'0'}}" class="form-control"></span>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>Confirm Password</label>
                <input type="password" name="confirmPassword" class="form-control">
                <div class="clearfix"></div><br>
                <input type="submit" name="btn_changePassword" value="Change Password" class="btn btn-primary">
            </form>
        </div>
        </div>
        <!-- /#wrapper -->
        <script type="text/javascript" src="{{ URL::asset('js/datepicker.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/dataTables.bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/Chart.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/custom.min.js')}}"></script>
    </body>
</html>

