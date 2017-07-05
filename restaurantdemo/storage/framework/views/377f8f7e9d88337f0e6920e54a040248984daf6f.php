<?php $__env->startSection('content'); ?>

<div class="col-xs-12" id="no-more-tables">
    <h3>Users</h3>
    <div class="clearfix"></div>
    <br/>
    <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addUser">ADD</button> -->
    <div class="clearfix"></div>
    <br/>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Type </th>
                <th>Change Password</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $usr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$i); ?></td>
                <td><?php echo e($usr->name); ?></td>
                <td><?php echo e($usr->email); ?></td>
                <td><?php echo e($usr->user_type_name); ?></td>
                <td><a data-toggle="modal" data-target="#changepassword" class="btn btn-danger" data-whatever="<?php echo e($usr->id); ?>" class="btn btn-danger">Change Password</a></td>
                <td>
                    <?php if($usr->status == 1): ?>
                        <p class="label label-success">Active</p>
                    <?php else: ?>
                        <p class="label label-danger">Blocked</p>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($usr->status == 1): ?>
                        <a data-toggle="modal" data-target="#blockuser"  data-whatever="<?php echo e($usr->id); ?>" class="btn btn-danger">Block</a>
                    <?php else: ?>
                        <a data-toggle="modal" data-target="#reactiveuser" data-whatever="<?php echo e($usr->id); ?>" class="btn btn-primary">Re-Activate</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<!-- <div id="addUser" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="<?php echo e(url('/manageUser')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_saveRestaurant">
                </div>
            </div>
        </form>
    </div>
</div> -->

<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?php echo e(url('/userChangePassword')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Reset Password?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_userId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="SendEmail">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="blockuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?php echo e(url('/manageUser/delete')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Block?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_userId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Block">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="reactiveuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?php echo e(url('/manageUser/reactive')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Activate?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_userId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Activate">
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
</script>
<script type="text/javascript">
    $('#changepassword').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-body input').val(recipient)
    })
</script>
<script type="text/javascript">
    $('#blockuser').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-body input').val(recipient)
    })
</script>
<script type="text/javascript">
    $('#reactiveuser').on('show.bs.modal', function (event)
    {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this)
        modal.find('.modal-body input').val(recipient)
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>