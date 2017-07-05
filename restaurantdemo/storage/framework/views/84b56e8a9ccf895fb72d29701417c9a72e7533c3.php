<?php $__env->startSection('content'); ?>

<div class="col-xs-12">
    <h3>Order Status</h3>
    <div class="clearfix"></div>
    <br>
    <button class="btn btn-primary pull-left" data-toggle="modal" data-target="#addOrder">ADD</button>
    <div class="clearfix"></div>
    <br>
    <table id="users" class="table table-hover table-condensed" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Order Status</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr>
                <?php $__currentLoopData = $restaurant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tbody>
        <td><?php echo e(++$i); ?></td>
        <td>Order Status</td>
        <td><p class="label label-success">Status</p></td>
        <td><a href="#" data-toggle="modal" data-target="#addOrder" class="btn btn-danger">Edit</a></td>
        <td><a href="#" class="btn btn-danger">Delete</a></td>
        </tbody>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        </thead>
    </table>
</div>
<div id="addOrder" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="<?php echo e(url('/manageOrderStatus')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Order</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Order Status</label>
                        <input type="text" name="txt_orderstatus" class="form-control">
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>