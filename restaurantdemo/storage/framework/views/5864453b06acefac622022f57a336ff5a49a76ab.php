<?php $__env->startSection('content'); ?>

<div class="col-xs-12">
    <h3>Customer Address</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-primary" data-toggle="modal" data-target="#addcusadd">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Customer Id</th>
                <th>Address</th>
                <th>Address Type Id</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Status</th>
                <th>City Id</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$i); ?></td>
                <td>Customer Id</td>
                <td>Address</td>
                <?php  
                $menuId = encrypt($customer->id);
                 ?>
                <td>Address Type Id</td>
                <td>Latitude</td>
                <td>Longitude</td>
                <td><p class="label label-success">Status</p></td>
                <td>City Id</td>
                <td><a href="<?php echo e(url('/customeraddress/edit/'.$menuId)); ?>" class="btn btn-danger">Edit</a></td>
                <td><a href="<?php echo e(url('/customeraddress/delete/'.$menuId)); ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div id="addcusadd" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="<?php echo e(url('/customeraddress/add')); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Customer Address</h4>
                </div>
                <div class="modal-body">

                    <div class="col-xs-12 col-md-6"><label>Cutomer</label>
                        <select class="form-control" name="ddl_customer">
                            <option value="0">---SELECT---</option>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cust->id); ?>"><?php echo e($cust->customer_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Address</label>
                        <textarea type="text" name="txtar_address" class="form-control"></textarea>
                    </div>
                    <div class="clearfix"></div><br>  
                    <div class="col-xs-12 col-md-6"><label>Address Type Id</label>
                        <input type="text" name="txt_addressid" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Latitude</label>
                        <input type="text" name="txt_latitude" class="form-control">
                    </div>
                    <div class="clearfix"></div><br>  
                    <div class="col-xs-12 col-md-6"><label>Logitude</label>
                        <input type="text" name="txt_logitude" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6"><label>City Id</label>
                        <input type="text" name="txt_cityid" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_save" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>