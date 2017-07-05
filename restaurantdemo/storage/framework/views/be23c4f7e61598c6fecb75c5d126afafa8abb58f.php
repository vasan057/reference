<?php $__env->startSection('content'); ?>

<div class="col-xs-12" id="no-more-tables">
    <h3>My Employees</h3>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addemployee">ADD</button>
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Position</th>
                <th>Restuarant Id</th>
                <th>User Present Status</th>
                <!-- <th>City</th> -->
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $userdets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$i); ?></td>
                <td><?php echo e($userdets->name); ?></td>
                <td><?php echo e($userdets->email); ?></td>
                <td><?php echo e($userdets->phone_number); ?></td>
                <td><?php echo e($userdets->user_type_name); ?></td>
                <td><?php echo e($userdets->restaurant_name); ?></td>
                <td>
                    <?php if($userdets->user_present_status == '1'): ?>
                            ONLINE
                        <?php else: ?>
                            OFFLINE
                    <?php endif; ?>
                </td>
                <!-- <td><?php echo e($userdets->city_name); ?></td> -->
                <td><p class="label label-success">Status</p></td>
                <?php  
                $userId = encrypt($userdets->empId);
                 ?>
                <td><a href="<?php echo e(url('/manageEmployees/edit/'.$userId)); ?>" class="btn btn-danger">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="<?php echo e($userdets->empId); ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div id="addemployee" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form method="post" action="<?php echo e(url('/manageEmployees/add')); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Employee</h4>
                </div>
                <div class="modal-body">
                <div class="col-xs-12 col-md-6">
                        <label>Employee Name</label>
                        <input type="text" name="txt_empName" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control" name="txt_email">
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <div class="col-xs-12 col-md-6">
                        <label>Phone Number</label>
                        <input type="text" name="txt_phno" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Password</label>
                        <input type="password" name="txt_password" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Positions</label>
                        <select name="ddl_position" class="form-control">
                            <option value="0" disabled="">---SELECT---</option>
                            <?php $__currentLoopData = $user_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usrType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($usrType->id); ?>"><?php echo e($usrType->user_type_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="clearfix"></div>
                    <br/>
                    <div class="col-xs-12 col-md-6">
                        <label>Restuarant</label>
                        <select name="ddl_restaurant" class="form-control">
                            <option value="0" disabled="">---Select Restuarant---</option>
                            <?php $__currentLoopData = $restaurant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rest->id); ?>"><?php echo e($rest->restaurant_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>City</label>
                        <select name="ddl_city" class="form-control">
                            <option value="0" disabled="">---Select City---</option>
                            <?php $__currentLoopData = $city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cities->id); ?>"><?php echo e($cities->city_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <?php 
                    /*<div class="col-xs-12 col-md-6">
                        <label>Employee Name</label>
                        <input type="text" name="txt_empName" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Address</label>
                        <textarea class="form-control" name="txtar_address"></textarea>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <div class="col-xs-12 col-md-6">
                        <label>Phone Number</label>
                        <input type="text" name="txt_phno" class="form-control">
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Positions</label>
                        <select name="ddl_position" class="form-control">
                            <option value="0" disabled="">---SELECT---</option>
                            @foreach($position as $positions)
                            <option value="{{$positions->id}}">{{$positions->position_title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="clearfix"></div>
                    <br/>
                    <div class="col-xs-12 col-md-6">
                        <label>Restuarant</label>
                        <select name="ddl_restaurant" class="form-control">
                            <option value="0" disabled="">---Select Restuarant---</option>
                            @foreach($restaurant as $rest)
                            <option value="{{$rest->id}}">{{$rest->restaurant_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>City</label>
                        <select name="ddl_city" class="form-control">
                            <option value="0" disabled="">---Select City---</option>
                            @foreach($city as $cities)
                            <option value="{{$cities->id}}">{{$cities->city_name}}</option>
                            @endforeach
                        </select>
                    </div>*/?>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="btn_saveEmployee" value="Save" class="btn btn-primary">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?php echo e(url('/manageEmployees/delete')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_employeeId">
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