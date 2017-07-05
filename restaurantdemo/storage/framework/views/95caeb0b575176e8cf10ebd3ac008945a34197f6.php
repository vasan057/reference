<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant</title>

        <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('bootstrap/css/bootstrap.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('font-awesome/css/font-awesome.min.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('css/local.css')); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('css/dataTables.bootstrap.min.css')); ?>" />

        <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('css/custom.min.css')); ?>">

        <script type="text/javascript" src="<?php echo e(URL::asset('js/jquery-1.10.2.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(URL::asset('bootstrap/js/bootstrap.min.js')); ?>"></script>

        <!-- you need to include the shieldui css and js assets in order for the charts to work -->
        <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
        <link id="gridcss" rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/dark-bootstrap/all.min.css" />

        <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
        <script type="text/javascript" src="http://www.prepbootstrap.com/Content/js/gridData.js"></script>

        <?php echo $__env->yieldContent('styles'); ?>
        <script>
window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
]); ?>

;
        </script>
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo e(url('/home')); ?>">Restaurant</a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul id="active" class="nav navbar-nav side-nav">
                        <li class="selected"><a href="<?php echo e(url('/home')); ?>"><i class="fa fa-bullseye"></i> Dashboard</a></li>
                        <li class="dropdown"><a class="dropdown dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cutlery"></i> Manage Restaurants <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(url('/manageRestaurents')); ?>"><i class="fa fa-cutlery"></i> My Restaurants</a></li>
                                <li><a href="<?php echo e(url('/manageCategories')); ?>"><i class="fa fa-list"></i> My Menu Categories</a></li>
                                <li><a href="<?php echo e(url('/manageMenuItems')); ?>"><i class="fa fa-bars"></i> My Menu Items</a></li>
                                <li><a href="<?php echo e(url('/manageMenu')); ?>"><i class="fa fa-list-ol"></i> My Menus</a></li>
                                <li><a href="<?php echo e(url('/manageDiningtable')); ?>"><i class="fa fa-spoon"></i> Dining Table</a></li>
                                <li><a href="<?php echo e(url('/manageSection')); ?>"><i class="fa fa-table"></i> Manage Section</a></li>
                                <li><a href="<?php echo e(url('/manageFloorView')); ?>"><i class="fa fa-map"></i> Manage Floor View</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown dropdown-toggle" data-toggle="dropdown"><i class="fa fa-list-alt"></i> Manage Orders <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(url('/manageOrders')); ?>"><i class="fa fa-list-alt"></i> My Orders</a></li>
                                <li><a href="<?php echo e(url('/deliveryTracks')); ?>"><i class="fa fa-truck"></i> Delivery</a></li>
                                <li><a href="<?php echo e(url('/manageDiningtabletracks')); ?>"><i class="fa fa-thumb-tack"></i> Dining Table Tracks</a></li>
                                <!-- <li><a href="<?php echo e(url('/manageBilling')); ?>"><i class="fa fa-credit-card-alt"></i> Billing</a></li> -->
                                <li><a href="<?php echo e(url('/manageReservation')); ?>"><i class="fa fa-cutlery"></i> Reservation</a></li>
                                <li><a href="<?php echo e(url('/manageMapView')); ?>"><i class="fa fa-map-signs"></i> Map View</a></li>

                            </ul>
                        </li>

                        <li class="dropdown"><a class="dropdown dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Manage Settings <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(url('/manageDinningTableStatus')); ?>"><i class="fa fa-spoon"></i> Dinning Table Status</a></li>
                                <li><a href="<?php echo e(url('/manageAddressTypes')); ?>"><i class="fa fa-newspaper-o"></i> Address Types</a></li>
                                <li><a href="<?php echo e(url('/manageOrderStatus')); ?>"><i class="fa fa-sticky-note-o"></i> Order Status</a></li>
                                <li><a href="<?php echo e(url('/manageOrderTypes')); ?>"><i class="fa fa-list"></i> Order Types</a></li>
                                <li><a href="<?php echo e(url('/managePositions')); ?>"><i class="fa fa-street-view"></i> Positions</a></li>
                                <li><a href="<?php echo e(url('/manageMasterCity')); ?>"><i class="fa fa-users"></i> Manage Master City</a></li>
                                <li><a href="<?php echo e(url('/manageSectionProperties')); ?>"><i class="fa fa-users"></i> Section Properties</a></li>
                                <li><a href="<?php echo e(url('/manageSectiontypes')); ?>"><i class="fa fa-users"></i> Section Types</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Manage Master <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(url('/manageCoupon')); ?>"><i class="fa fa-users"></i> Manage Coupons</a></li>
                                <li><a href="<?php echo e(url('/manageBanner')); ?>"><i class="fa fa-users"></i> Manage Banners</a></li>
                                <li><a href="<?php echo e(url('/manageImagereference')); ?>"><i class="fa fa-users"></i> Image Reference</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo e(url('/manageCustomers')); ?>"><i class="fa fa-users"></i> Customer</a></li>
                        <li><a href="<?php echo e(url('/manageEmployees')); ?>"><i class="fa fa-user"></i> My Employees</a></li>
                        <li><a href="<?php echo e(url('/changePassword')); ?>"><i class="fa fa-key"></i> Change Password</a></li>
                        <li><a href="<?php echo e(url('/manageUser')); ?>"><i class="fa fa-users"></i> User</a></li>
                        <!-- <li><a href="portfolio.html"><i class="fa fa-tasks"></i> Portfolio</a></li>
                        <li><a href="blog.html"><i class="fa fa-globe"></i> Blog</a></li>
                        <li><a href="signup.html"><i class="fa fa-list-ol"></i> SignUp</a></li>
                        <li><a href="register.html"><i class="fa fa-font"></i> Register</a></li>
                        <li><a href="timeline.html"><i class="fa fa-font"></i> Timeline</a></li>
                        <li><a href="forms.html"><i class="fa fa-list-ol"></i> Forms</a></li>
                        <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
                        <li><a href="bootstrap-elements.html"><i class="fa fa-list-ul"></i> Bootstrap Elements</a></li>
                        <li><a href="bootstrap-grid.html"><i class="fa fa-table"></i> Bootstrap Grid</a></li> -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li class="dropdown messages-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">2</span> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">2 New Messages</li>
                                <li class="message-preview">
                                    <a href="#">
                                        <span class="avatar"><i class="fa fa-bell"></i></span>
                                        <span class="message">Security alert</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li class="message-preview">
                                    <a href="#">
                                        <span class="avatar"><i class="fa fa-bell"></i></span>
                                        <span class="message">Security alert</span>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Go to Inbox <span class="badge">2</span></a></li>
                            </ul>
                        </li>
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo e(Auth::user()->name); ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();"> <i class="fa fa-power-off"></i>
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                                <li>
                            </ul>
                        </li>
                        <li class="divider-vertical"></li>
                        <!-- <li>
                            <form class="navbar-search">
                                <input type="text" placeholder="Search" class="form-control">
                            </form>
                        </li> -->
                    </ul>
                </div>
            </nav>

            <?php if(Session::has('flash_message')): ?>
            <div class="clearfix"></div><br>
            <div class="alert alert-success col-md-10 col-md-offset-1" style="margin-top:5px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="font-size:16px;"><strong>Success!!</strong> <?php echo Session::get('flash_message'); ?></p>
            </div>
            <?php endif; ?>

            <?php if(Session::has('wrong_message')): ?>
            <div class="clearfix"></div><br>
            <div class="alert alert-danger col-md-10 col-md-offset-1" style="margin-top:5px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="font-size:16px;"><strong>Sorry!!</strong> <?php echo Session::get('wrong_message'); ?></p>
            </div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /#wrapper -->
        <script type="text/javascript" src="<?php echo e(URL::asset('js/datepicker.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.dataTables.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(URL::asset('js/dataTables.bootstrap.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(URL::asset('js/Chart.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(URL::asset('js/custom.min.js')); ?>"></script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3q5EB4M592aWIM2Xws5EwcFYe8U2Zvlc&callback=initMap"></script>

        <script>
               $(document).ready(function () {
                   $('#zctb').DataTable();
               })
        </script>
        <script type="text/javascript">
            jQuery(function ($) {
                var performance = [12, 43, 34, 22, 12, 33, 4, 17, 22, 34, 54, 67],
                        visits = [123, 323, 443, 32],
                        traffic = [
                            {
                                Source: "Direct", Amount: 323, Change: 53, Percent: 23, Target: 600
                            },
                            {
                                Source: "Refer", Amount: 345, Change: 34, Percent: 45, Target: 567
                            },
                            {
                                Source: "Social", Amount: 567, Change: 67, Percent: 23, Target: 456
                            },
                            {
                                Source: "Search", Amount: 234, Change: 23, Percent: 56, Target: 890
                            },
                            {
                                Source: "Internal", Amount: 111, Change: 78, Percent: 12, Target: 345
                            }];


                $("#shieldui-chart1").shieldChart({
                    theme: "dark",

                    primaryHeader: {
                        text: "Visitors"
                    },
                    exportOptions: {
                        image: false,
                        print: false
                    },
                    dataSeries: [{
                            seriesType: "area",
                            collectionAlias: "Q Data",
                            data: performance
                        }]
                });

                $("#shieldui-chart2").shieldChart({
                    theme: "dark",
                    primaryHeader: {
                        text: "Traffic Per week"
                    },
                    exportOptions: {
                        image: false,
                        print: false
                    },
                    dataSeries: [{
                            seriesType: "pie",
                            collectionAlias: "traffic",
                            data: visits
                        }]
                });

                $("#shieldui-grid1").shieldGrid({
                    dataSource: {
                        data: traffic
                    },
                    sorting: {
                        multiple: true
                    },
                    rowHover: false,
                    paging: false,
                    columns: [
                        {field: "Source", width: "170px", title: "Source"},
                        {field: "Amount", title: "Amount"},
                        {field: "Percent", title: "Percent", format: "{0} %"},
                        {field: "Target", title: "Target"},
                    ]
                });
            });
        </script>
        <?php echo $__env->yieldContent('scripts'); ?>
    </body>
</html>
