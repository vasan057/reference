<?php $__env->startSection('content'); ?>

<div class="col-xs-12" id="no-more-tables">
    <h3>Map View</h3> 
    <div class="clearfix"></div><br>     
    <div class="row">
        <div class="col-xs-12 col-md-8"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.5837201044933!2d80.25629031482227!3d12.998455990838238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5267f8c1da5fd5%3A0x82397996507546d3!2sFalconnect+Technologies+Private+Ltd!5e0!3m2!1sen!2sin!4v1496216557944" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            <div>
                <ul class="all-rest">
                <li>All Restaurant</li>
                <li>Restaurant 1</li>
                <li>Restaurant 2</li>
                <li>Restaurant 3</li>
                <li>Restaurant 4</li>
                </ul>
            </div></div>
        <div class="col-xs-12 col-md-4">
            <div class="row">
                <h3>Restaurant</h3>
                <p class="tab-head"><span>Not Accepted (2)</span> <span>Out For Delivery (2)</span> <span>Inprogress (2)</span> <span>Accepted (2)</span></p>
                <br>
                <div class="col-xs-12">
                    <h4 class="label-danger label">Not Accepted</h4>
                    <table class="table table-hover table-condensed" style="width:100%">
                        <tbody>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12">
                    <h4 class="label-success label">Out For Delivery</h4>
                    <table class="table table-hover table-condensed" style="width:100%">
                        <tbody>
                            <tr>
                                <td>6km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.1400</td>
                            </tr>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                            <tr>
                                <td>1km</td>
                                <td>
                                    Address
                                </td>
                                <td>Rs.300</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>