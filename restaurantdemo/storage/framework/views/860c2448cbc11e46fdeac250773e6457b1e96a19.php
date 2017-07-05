<?php $__env->startSection('content'); ?>

<div class="col-xs-12" id="no-more-tables">
    <h3>Map View</h3> 
    <div class="clearfix"></div><br>     
    <div class="row">
        <!-- <div class="col-xs-12 col-md-8"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.5837201044933!2d80.25629031482227!3d12.998455990838238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5267f8c1da5fd5%3A0x82397996507546d3!2sFalconnect+Technologies+Private+Ltd!5e0!3m2!1sen!2sin!4v1496216557944" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
        <style type="text/css">
#map {
    height: 100%;
}
        </style>
        <div id="map"></div>
            <div>
                <ul class="all-rest">
                <li>All Restaurant</li>
                <?php $__currentLoopData = $restaurant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rests): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($rests->restaurant_name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div></div>
        <div class="col-xs-12 col-md-4">
            <div class="row">
                <h3>Restaurant</h3>
                <p class="tab-head"><span>Not Accepted (2)</span> <span>Out For Delivery (2)</span> <span>Inprogress (2)</span> <span>Accepted (2)</span></p>
                <br>
                <div class="col-xs-12">
                    <h4 class="label-danger label">Not Accepted</h4>
                    <table class="table table-hover table-condensed" style="width:100%">
                        <tbody>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12">
                    <h4 class="label-success label">Out For Delivery</h4>
                    <table class="table table-hover table-condensed" style="width:100%">
                        <tbody>
                            <tr>
                                <td>6km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.1400</td>
                            </tr>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });</script>

<script type="text/javascript">
    function initMap() {
    
    var broadway = {
        info: '<strong>Chipotle on Broadway</strong><br>\
                    5224 N Broadway St<br> Chicago, IL 60640<br>\
                    <a href="https://goo.gl/maps/jKNEDz4SyyH2">Get Directions</a>',
        lat: 41.976816,
        long: -87.659916
    };

    var belmont = {
        info: '<strong>Chipotle on Belmont</strong><br>\
                    1025 W Belmont Ave<br> Chicago, IL 60657<br>\
                    <a href="https://goo.gl/maps/PHfsWTvgKa92">Get Directions</a>',
        lat: 41.939670,
        long: -87.655167
    };

    var sheridan = {
        info: '<strong>Chipotle on Sheridan</strong><br>\r\
                    6600 N Sheridan Rd<br> Chicago, IL 60626<br>\
                    <a href="https://goo.gl/maps/QGUrqZPsYp92">Get Directions</a>',
        lat: 42.002707,
        long: -87.661236
    };

    var locations = [
      [broadway.info, broadway.lat, broadway.long, 0],
      [belmont.info, belmont.lat, belmont.long, 1],
      [sheridan.info, sheridan.lat, sheridan.long, 2],
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: new google.maps.LatLng(41.976816, -87.659916),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow({});

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>