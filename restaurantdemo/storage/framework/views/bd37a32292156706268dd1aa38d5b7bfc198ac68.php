<?php $__env->startSection('content'); ?>

<div class="col-xs-12" id="no-more-tables">
    <h3>Restaurant</h3>
    <div class="clearfix"></div><br/>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addRestaurant">ADD</button>
    <div class="clearfix"></div>
    <br/>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered display"  cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>About Restaurant</th>
                <th>Image</th>
                <th>Menu</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $restaurant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$i); ?></td>
                <td><?php echo e($rest->restaurant_name); ?></td>
                <td><?php echo e($rest->address); ?></td>
                <td><?php echo e($rest->phone_number); ?></td>
                <td><?php echo e($rest->about_restaurant); ?></td>
                <td><img src="<?php echo e($rest->image_url); ?>" class="col-md-8" /></td>
                <td><?php echo e($rest->menu_version); ?></td>
                <td><p class="label label-success">Status</p></td>
                <?php  
                $resturantId = encrypt($rest->restuarantId);
                 ?>
                <td><a href="<?php echo e(url('/manageRestaurents/edit/'.$resturantId)); ?>" class="btn btn-danger">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="<?php echo e($rest->restuarantId); ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<div id="addRestaurant" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="<?php echo e(url('/manageRestaurents')); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Restaurant</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Restaurant Name</label>
                        <input type="text" name="txt_restaurantName" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Restaurant Address</label>
                        <textarea class="form-control" name="txt_restaurantAddress"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Phone</label>
                        <input type="text" name="txt_phone" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>About</label>
                        <textarea class="form-control" name="txtar_restDesc"></textarea>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Menu</label>
                        <select class="form-control" name="ddl_menu">
                            <option value="0">---SELECT---</option>
                            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($menus->id); ?>"><?php echo e($menus->menu_version); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Restaurant Image</label>
                        <input type="file" name="fl_restImg" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>User</label>
                        <select class="form-control" name="ddl_users">
                            <option value="0">---SELECT---</option>
                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($usr->id); ?>"><?php echo e($usr->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>City</label>
                        <select class="form-control" name="ddl_city">
                            <option value="0">---SELECT---</option>
                            <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cities->id); ?>"><?php echo e($cities->city_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Opening Hours</label>
                        <input type="text" name="txt_openinghr" class="form-control" >
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Closing Hours</label>
                        <input type="text" name="txt_closinghr" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Delivery Opening Hours</label>
                        <input type="text" name="txt_delopenhr" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Delivery Closing Hours</label>
                        <input type="text" name="txt_delclosehr" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Price Range</label>
                        <input type="text" name="txt_priceRange" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Minimum Home Delivery</label>
                        <input type="text" name="txt_minHomeDelivery" class="form-control">
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <label>Average Rating</label>
                        <input type="text" name="txt_rating" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Directions</label>
                        <input type="text" name="txt_direct" class="form-control">
                    </div>
                    <br>
                    <div class="col-xs-12 col-md-2">
                        <div class="checkbox">
                            <label><input type="checkbox" name="chk_homeDelivery" value="1">Home Delivery</label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <div class="checkbox">
                            <label><input type="checkbox" name="chk_tableBooking" value="1">Table Booking</label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <div class="checkbox">
                            <label><input type="checkbox" name="chk_pickup" value="1">Pickup</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_saveRestaurant">
                </div>
            </div>
        </form>
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