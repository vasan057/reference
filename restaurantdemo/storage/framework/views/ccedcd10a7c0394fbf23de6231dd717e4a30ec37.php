<?php $__env->startSection('content'); ?>
<div class="col-xs-12" id="no-more-tables">
    <h3>Billing</h3>
    <div class="clearfix"></div>
    <br/>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addBilling">ADD</button>
    <div class="clearfix"></div>
    <br/>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Order </th>
                <th>Bill Date</th>
                <th>Amount</th>
                <th>Discount</th>
                <th>Restaurant </th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $billing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$i); ?></td>
                <td><?php echo e($bill->order_id); ?></td>
                <td><?php echo e($bill->bill_date); ?></td>
                <td><?php echo e($bill->amount); ?></td>
                <td><?php echo e($bill->discount); ?></td>
                <td><?php echo e($bill->restaurant_name); ?></td>
                <?php 
                    $billId = encrypt($bill->id)
                 ?>
                <td><p class="label label-success">Status</p></td>
                <td><a href="<?php echo e(url('/manageBilling/edit/'.$billId)); ?>" class="btn btn-danger">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="<?php echo e($bill->id); ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div id="addBilling" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="<?php echo e(url('/manageBilling/add')); ?>" method="post">
            <?php echo e(csrf_field()); ?>


            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Billing</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6"><label>Order Id</label>
                        <select name="ddl_orderId" class="form-control" id="ddl_orderId">
                            <option value="0">---SELECT---</option>
                            <?php $__currentLoopData = $orderDets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordDets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ordDets->id); ?>"><?php echo e($ordDets->id); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Bill Date</label>
                        <div class="input-group date" id="datetimepicker4">
                            <input type="text" name="txt_billdate" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br/>
                    <div class="col-xs-12 col-md-6">
                        <label>Amount</label>
                        <input type="text" name="txt_amount" class="form-control" id="txt_amount" readonly>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Discount</label>
                        <input type="text" name="txt_discount" class="form-control" id="txt_discount">
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="col-xs-12 col-md-6"><label>Restuarant Id</label>
                        <select class="form-control" name="ddl_restaurant" id="ddl_restaurant">
                            <option value="0">---SELECT---</option>
                            <?php $__currentLoopData = $restaurant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($rest->id); ?>"><?php echo e($rest->restaurant_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <br/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-default" value="Save" name="btn_saveBill">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?php echo e(url('/manageBilling/delete')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_billId">
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
<script type="text/javascript">
        $("#ddl_orderId").change(function () {
            var orderId = $(this).val();
            token = "<?php echo e(csrf_token()); ?>";
            $.ajax({
                type: "GET",
                url: "<?php echo e(url('getOrderDetsAjax')); ?>?orderId=" + orderId,
                success: function (res)
                {
                    //$("#txt_discount").empty();
                    $("#txt_amount").val(res[0].totalAmount);
                    $("#ddl_restaurant").val(res[0].restaurant_id)
                }
            });
        });
</script>
<script>
$('.date').datetimepicker({
    autoclose: true,
            format: "yyyy-mm-dd",
            startView: "month",
            minView: "month",
            maxView: "decade"
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>