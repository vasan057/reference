<?php $__env->startSection('content'); ?>
<div class="col-xs-12" id="no-more-tables">
    <h3>Positions</h3>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addPositions">ADD</button>
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Positons</th>
                <th>status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $position; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $posi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$i); ?></td>
                <td><?php echo e($posi->position_title); ?></td>
                <?php 
                $positionId = encrypt($posi->id);
                 ?>
                <td><p class="label label-success">Status</p></td>
                <td><a href="" data-toggle="modal" data-target="#editPositions" class="btn btn-danger" id="<?php echo e($posi->id); ?>" >Edit</a></td>
                <td><a href="<?php echo e(url('/managePositions/delete/'.$positionId)); ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div id="addPositions" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="<?php echo e(url('/managePositions/Add')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Positons</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Position Title</label>
                        <input type="text" name="position_title" class="form-control">
                    </div>
                </div>
                <div class="clearfix"></div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_savePosition">
                </div>
            </div>
        </form>
    </div>
</div>
<div id="editPositions" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="<?php echo e(url('/managePositions/Add')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Positons</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Position Title</label>
                        <input type="text" name="position_title" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Status</label>
                        <select class="form-control" name="position_status">
                            <option value="0">Select Status</option>
                            <option value="1">Status</option>
                            <option value="2">Status</option>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_savePosition">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>