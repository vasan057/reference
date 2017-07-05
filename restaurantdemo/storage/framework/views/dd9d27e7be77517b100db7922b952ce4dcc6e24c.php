<?php $__env->startSection('content'); ?>
<style>

#map {
    height: 80%;
    width:50%;
    position: absolute !important;
    overflow: auto !important;
}
    </style>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
  

    <div class="col-xs-12" id="no-more-tables">
    <div id="map"></div>
        <div class="col-md-7 col-xs-12">
            
        </div>
        <div class="col-md-5 col-xs-12" id="no-more-tables">
            <div class="row over-hide">
            <h3>Restaurant</h3>
            <div class="clearfix"></div><br/>
            <a class="btn btn-danger" href="<?php echo e(url('/addNewRestaurant')); ?>">ADD</a>
            <div class="clearfix"></div>
            <br/>
            <table id="users" class="table-rest table table-hover table-condensed table-striped table-bordered display"  cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <!--<th>Id</th>-->
                        <th>Name</th>
                        <th>Address</th>
                        <!--<th>Phone Number</th>-->
                        <!--<th>About Restaurant</th>-->
                        <!--<th>Image</th>-->
                        <!--<th>Menu</th>-->
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $restaurant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <!--<td><?php echo e(++$i); ?></td>-->
                        <input type="text" id="txt_longitude" value="<?php echo e($rest->latitude); ?>" name="txt_longitude">
                        <input type="text" id="txt_longitude" value="<?php echo e($rest->longitude); ?>" name="txt_longitude">
                        
                        
                        <td  data-title="Name"><img src="<?php echo e($rest->image_url); ?>" width="100"/></td>
                        <td data-title="Address"> <b><?php echo e($rest->restaurant_name); ?></b>
                            <p class="rest-text"><?php echo e($rest->address); ?>,                        <?php echo e($rest->phone_number); ?></p>
                        </td>
                        <!--<td><?php echo e($rest->address); ?></td>-->
                        <!--<td><?php echo e($rest->phone_number); ?></td>-->
                        <!--<td><?php echo e($rest->about_restaurant); ?></td>-->
                        <!--<td><img src="<?php echo e($rest->image_url); ?>"/></td>-->
                        <!--<td><?php echo e($rest->menu_version); ?></td>-->
                        <td data-title="Status"><p class="label label-success">Status</p></td>
                        <?php  
                        $resturantId = encrypt($rest->restuarantId);
                         ?>
                        <td data-title="Edit"><a href="<?php echo e(url('/manageRestaurents/edit/'.$resturantId)); ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                        <td data-title="Delete"><a data-toggle="modal" data-target="#deleteModel" class="btn btn-xs btn-danger" data-whatever="<?php echo e($rest->restuarantId); ?>" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="<?php echo e(url('/manageRestaurents/delete')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                            <input type="hidden" class="form-control" id="recipient-name" name="txt_restaurantId">
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
// $("tr").mouseover(function(){
//     var txt1 = $("#txt_longitude").val();
//     var txt2 = $("#txt_longitude").val();
//             //alert(txt1);
// });


//google map working
var map;

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: -34.397,
            lng: 150.644
        },
        zoom: 8
    });
}
function initMap() {
    var getlocations = <?php print_r(json_encode($locationsdb)) ?>;
    broadway = [];
    locations = [];
    //console.log(getlocations);
    $.each( getlocations, function( index, value )
    {
        broadway.push({
        info: value.restaurant_name,
        lat: value.latitude,
        long:value.longitude
        });
        locations.push(
          [broadway[index].info, broadway[index].lat, broadway[index].long, index]);
    });
    
    // var broadway = {
    //     info: '<strong>Chipotle on Broadway</strong><br>\
    //                 5224 N Broadway St<br> Chicago, IL 60640<br>\
    //                 <a href="https://goo.gl/maps/jKNEDz4SyyH2">Get Directions</a>',
    //     lat: 13.0826802,
    //     long: 80.2707184
    // };


    // var locations = [
    //   [broadway.info, broadway.lat, broadway.long, 0],
    // ];
    //alert(locations);
        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 11,
        //setting default place
        center: new google.maps.LatLng(13.0826802, 80.2707184),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow({});

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {
            //$("tr").mouseover(function(marker, i){
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));

        // google.maps.event.addListener("<tr>", 'mouseover', (function (marker, i) {
        //     //$("tr").mouseover(function(marker, i){
        //         alert();
        //     return function () {
        //         infowindow.setContent(locations[i][0]);
        //         infowindow.open(map, marker);
        //     }
        // })(marker, i));
    }
}
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>