<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
					<h2 class="pull-left">
						Trader
					</h2>
						<br>
				</div>
				
				<div class="body">
					
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>                                        
										<th>Name</th>
										<th>Phone No</th>
										<th>Address</th>										
										<th>Created at</th>
										<th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($objTrader as $trader): ?>
										<tr>
											<td><?php echo e($trader->id); ?></td>
											<td><?php echo e($trader->firstName); ?> <?php echo e($trader->lastName); ?></td>
											<td><?php echo e($trader->mobile); ?></td>
											<td><?php echo e($trader->location); ?></td>
											<td><?php echo e($trader->createdDate); ?></td>
											<td>
											<!--a href="#" data-toggle="tooltip" title="Edit" style="text-decoration: none;" class="btn btn-md btn-primary material-icons edit_data" id="btndeliveryboyEdit" data-url="">mode_edit</a-->
											<a href="<?php echo e(URL::to('user/'.Helper::encode($trader->id).'/view')); ?>" data-toggle="tooltip" title="View" style="text-decoration: none;" class="material-icons waves-effect btn btn-primary"  data-url="">visibility</a>
 
											<a href="#" type="button" class="material-icons js-sweetalert waves-effect" data-type="delete" data-toggle="tooltip" title="delete" data-url="trader/<?php echo e($trader->id); ?>/delete"  style="text-decoration: none;">delete_forever</a>
											<a href="<?php echo e(URL::to('user/'.Helper::encode($trader->id).'/products')); ?>" type="button" class="material-icons waves-effect" data-type="Activity" data-toggle="tooltip" title="Activity" data-url="trader/<?php echo e(Helper::encode($trader->id)); ?>/products"  style="text-decoration: none;">dvr</a>
											<?php if($trader->status == env('ACTIVE')): ?>
											
													<a href="<?php echo e(URL::to('user/'.Helper::encode($trader->user_id).'/'.env('NOTACTIVE').'/trader/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set De-active" data-url=""  style="text-decoration: none;color:green;">remove_circle</a>
												<?php else: ?>
													<a href="<?php echo e(URL::to('user/'.Helper::encode($trader->user_id).'/'.env('ACTIVE').'/trader/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-danger" data-toggle="tooltip" title="Set Active" data-url=""  style="text-decoration: none;color:red;">check_circle</a>
												<?php endif; ?>
											</td> 

										</tr>
									<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    
					</div>
				</div>	
			</div>	
		</div>	
				
</section>
<!-- #END# Tabs With Icon Title -->

 
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>