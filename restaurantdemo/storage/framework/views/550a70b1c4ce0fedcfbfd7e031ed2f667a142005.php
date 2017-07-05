<?php $__env->startSection('content'); ?>
<form action="<?php echo e(url('/manageRestaurents')); ?>" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

                        <?php echo $__env->make('admin.manageImages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="clearfix"></div><br/>
    <div class="col-xs-12 col-md-6"><label>Restaurant Name</label>
        <input type="text" name="txt_restaurantName" class="form-control">
    </div>
    <div class="col-xs-12 col-md-6">
        <label>Restaurant Address</label>
        <textarea class="form-control" name="txt_restaurantAddress"></textarea>
    </div>
    <div class="col-xs-12 col-md-6">
        <label>Latitiude</label>
        <input type="text" name="txt_latitude" class="form-control">
    </div>
    <div class="col-xs-12 col-md-6">
        <label>Longitude</label>
        <input type="text" name="txt_longitude" class="form-control">
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
    <!--  <div class="col-xs-12 col-md-6">
            <label>Restaurant Image</label>
            <input type="file" name="fl_restImg" class="form-control">
        </div>-->
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
    <br>
    <input type="submit" class="btn btn-default" value="Save" name="btn_saveRestaurant">
</form>

<div class="clearfix"></div><br/>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>