<?php $__env->startSection('content'); ?>

<div class="col-xs-8 col-xs-offset-2">
    <h3>Change Password</h3>

    <div class="clearfix"></div><br>
    <form method="post" action="<?php echo e(url('/changePassword')); ?>">
        <?php echo e(csrf_field()); ?>

        <label>Old Password</label>
        <input type="password" name="txt_oldPassword" class="form-control">
        <div class="clearfix"></div><br>
        <label>New Password</label>
        <input type="password" name="txt_newPassword" class="form-control">
        <div class="clearfix"></div><br>
        <label>Re Type Password</label>
        <input type="password" name="txt_confirmPassword" class="form-control">
        <div class="clearfix"></div><br>
        <input type="submit" name="btn_changePassword" value="Change Password" class="btn btn-primary">
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>