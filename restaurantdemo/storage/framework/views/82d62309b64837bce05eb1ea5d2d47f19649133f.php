<?php $__env->startSection('content'); ?>

<div class="col-xs-12" id="no-more-tables">
    <h3>Orders</h3> 
    <div class="clearfix"></div><br>     
    <button class="btn btn-danger" data-toggle="modal" data-target="#addorder">ADD</button> 
    <div class="clearfix"></div><br>
    <table id="users" class="table table-hover table-condensed table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Order Date</th>
                <th>Order Type</th>
                <th>Restaurant Name</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Total Items</th>
                <th>Change Order Status</th>
                <th>Billing</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id="">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="tb_order">
                <td><?php echo e(++$i); ?></td>
                <td><?php echo e($order->order_date); ?></td>
                <td><?php echo e($order->order_type_name); ?></td>
                <?php  
                $orderId    = encrypt($order->id);
                $customerId = encrypt($order->customer_id);
                 ?>
                <td><?php echo e($order->restaurant_name); ?></td>
                <td><?php echo e($order->customer_name); ?></td>
                <td>
                    <?php echo e($order->totalPrice); ?>

                </td>
                <td><?php echo e($order->totalItems); ?></td>
                <td>
                <?php if($order->ordrstatusid == '1'): ?>
                    <p class="label label-success"><?php echo e($order->ordstatus); ?></p>
                <?php elseif($order->ordrstatusid == '2'): ?>
                    <p class="label label-success"><?php echo e($order->ordstatus); ?></p>
                <?php elseif($order->ordrstatusid == '3'): ?>
                    <p class="label label-success"><?php echo e($order->ordstatus); ?></p>
                <?php elseif($order->ordrstatusid == '4'): ?>
                    <p class="label label-success"><?php echo e($order->ordstatus); ?></p>
                <?php elseif($order->ordrstatusid == '5'): ?>
                    <p class="label label-success"><?php echo e($order->ordstatus); ?></p>
                <?php elseif($order->ordrstatusid == '6'): ?>
                    <p class="label label-primary"><?php echo e($order->ordstatus); ?></p>
                <?php elseif($order->ordrstatusid == '13'): ?>
                    <p class="label label-success"><?php echo e($order->ordstatus); ?></p>
                <?php endif; ?>
                    <a class="btn btn-primary" href="#myModal" data-toggle="modal" id="<?php echo e($order->id); ?>" data-target="#popup1">Change</a>
                </td>
                <td>
                    <p class="btn btn-sm btn-primary"><a href="<?php echo e(url('/manageBilling')); ?>">Generate Bill</a></p>
                    <p></p>
                    <p class="btn btn-sm btn-primary">Track</p></td>
                <td><a href="<?php echo e(url('/manageOrders/edit/'.$orderId.'/'.$customerId)); ?>" class="btn btn-primary">Edit</a></td>
                <td><a data-toggle="modal" data-target="#deleteModel" class="btn btn-danger" data-whatever="<?php echo e($order->id); ?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div id="addorder" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="<?php echo e(url('/manageOrders/add')); ?>">
            <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Order</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-md-6">
                        <label>Order Date</label>
                        <div class="input-group date" id="datetimepicker4" name="txt_orderdate">
                            <input type="text" name="txt_orddate" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="">
                            <span class="input-group-addon testdrivepoint-outer">
                                <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Order Type</label>
                        <select class="form-control" name="ddl_ordertype">
                            <option value="0">---SELECT</option>
                            <?php $__currentLoopData = $Order_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($order->id); ?>"><?php echo e($order->order_type_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Customer Name</label>
                        <select class="form-control" name="ddl_cusname" id="ddl_cusname">
                            <option value="0">---SELECT---</option>
                            <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cust->id); ?>"><?php echo e($cust->customer_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Customer Address</label>
                        <select class="form-control" name="ddl_cusaddress" id="ddl_cusaddress">
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <label>Restaurant Name</label>
                        <select class="form-control" name="ddl_restname">
                            <option value="0">---SELECT---</option>
                            <?php $__currentLoopData = $restaurant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restrnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($restrnt->id); ?>"><?php echo e($restrnt->restaurant_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-xs-12 col-md-6"><label>Order Status</label>
                        <select class="form-control" name="ddl_ordestatus">
                            <option value="0">---SELECT---</option>
                            <?php $__currentLoopData = $Order_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordrstatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($ordrstatus->id); ?>"><?php echo e($ordrstatus->order_status_desc); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div><br>  
                <div class="modal-footer">
                    <input type="submit" name="btn_saveOrder" value="Save" class="btn btn-default">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="popup1" tabindex="-1" role="dialog" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Status</h4>
            </div>
            <form method="post" action="<?php echo e(url('/getOrderStatus')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body edit-content">
                    <div class="row">
                        <input type="hidden" name="txt_OrderId" id="txt_OrderId">
                        <div class="col-xs-12 col-sm-12">
                            <select class="form-control" name="ddl_orderStatus" id="ddl_orderStatus">
                                <option value="0">---SELECT---</option>
                                <?php $__currentLoopData = $orderstatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordsta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ordsta->id); ?>"><?php echo e($ordsta->order_status_desc); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div><br>
                        <div id="div_onchange" style="display: none;">
                            <div class="col-xs-12 col-sm-12" >
                                <select class="form-control" id="ddl_deliveryboy"  >
                                    <option value="0">--SELECT---</option>
                                    <?php $__currentLoopData = $deiveryBoys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delboys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($delboys->id); ?>"><?php echo e($delboys->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <br>
                            <div class="col-xs-12 col-sm-12">
                                <div class="input-group date" id="datetimepicker4">
                                    <input type="text" name="txt_estimatedTime" placeholder="DD-MM-YYYY" class="form-control purchase_date_own required-des" value="" id="txt_estimatedTime">
                                    <span class="input-group-addon testdrivepoint-outer">
                                        <span class="glyphicon glyphicon-calendar testdrivepoint-outer"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="Submit" name="btn_ChangeStatus" value="save" class="btn btn-primary send-again">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?php echo e(url('/manageOrders/delete')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Are You Sure Do You Want to Delete?</label>
                        <input type="hidden" class="form-control" id="recipient-name" name="txt_OrderId">
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
    $("#ddl_cusname").change(function () {
        var customerId = $(this).val();
        token = "<?php echo e(csrf_token()); ?>";
        $.ajax({
            type: "GET",
            url: "<?php echo e(url('getCustomerAddress')); ?>?customerId=" + customerId,
            success: function (res)
            {
                //console.log(res);
                $("#ddl_cusaddress").empty();
                $("#ddl_cusaddress").append('<option value="0">---SELECT---</option>');
                $("#ddl_cusaddress").append('<option value="' + res[0].id + '">' + res[0].address + '</option>');
            }
        });
    });
</script>

<script type="text/javascript">
    $('#popup1').on('show.bs.modal', function (e)
    {
        var token, data;
        var $modal = $(this),
                esseyId = e.relatedTarget.id;
        //alert(esseyId);
        token = "<?php echo e(csrf_token()); ?>";
        data = {id: esseyId};
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            url: "<?php echo e(url('/getOrderStatus')); ?>",
            data: {id: esseyId},
            datatype: 'JSON',
            success: function (data)
            {
                $("#ddl_orderStatus").val(data[0].order_status_id);
                $("#txt_OrderId").val(data[0].id);
                if ($('#ddl_orderStatus').val() == '4') 
                {
                    $('#div_onchange').show();
                    $("#txt_estimatedTime").val(data[0].estimated_time);
                    $('#ddl_deliveryboy').val(data[0].users_id)
                }
                else 
                {
                    $('#div_onchange').hide();
                }
            }
            // error: function () 
            // {
            //     alert();
            // }
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

<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });
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

<script type="text/javascript">
    $('#ddl_orderStatus').change(function () {
        if ($('#ddl_orderStatus').val() == '4')
        {
            $('#div_onchange').show();
        } else
        {
            $('#div_onchange').hide();
        }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>