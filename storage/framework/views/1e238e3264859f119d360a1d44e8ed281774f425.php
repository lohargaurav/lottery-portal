<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
					<h2 class="pull-left">
						<?php if(Auth::user()->isAdmin): ?>Franchisees <?php else: ?> Customers <?php endif; ?> List
					</h2>
						<br>
				</div>
				
				<div class="body">
					
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>                                        
										<th>Name</th>
										<th>Email</th>										
										<th>Phone No</th>
										<th>Address</th>										
										<th>Created at</th>
										<th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
								
									<?php foreach($usersLists as $key => $usersList): ?>
										<tr>
											<td><?php echo e(++$key); ?></td>
											<td><?php echo e($usersList->name); ?></td>
											<td><?php echo e($usersList->email); ?></td>
											<td><?php echo e($usersList->mobile); ?></td>
											<td><?php echo e($usersList->address); ?></td>
											<td><?php echo e($usersList->created_date); ?></td>
											<td>
												<a href="<?php echo e(URL::to('user/'.Helper::encode($usersList->id).'/view')); ?>" data-toggle="tooltip" title="View" style="text-decoration: none;" class="material-icons waves-effect btn btn-primary"  data-url="">visibility</a>
 
												
												
												<?php if(Auth::user()->isAdmin): ?>
												
													<?php if($usersList->approved_by_admin == env('ACTIVE')): ?>
												
														<a href="<?php echo e(URL::to('user/'.Helper::encode($usersList->id).'/'.env('NOTACTIVE').'/franchisee/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set Unapproved" data-url=""  style="text-decoration: none;">remove_circle</a>
													<?php else: ?>
														<a href="<?php echo e(URL::to('user/'.Helper::encode($usersList->id).'/'.env('ACTIVE').'/franchisee/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-danger" data-toggle="tooltip" title="Set Approved" data-url=""  style="text-decoration: none;">check_circle</a>
													<?php endif; ?>
												<?php else: ?>
													<?php if($usersList->approved_by_franchisee == env('ACTIVE')): ?>
												
														<a href="<?php echo e(URL::to('user/'.Helper::encode($usersList->id).'/'.env('NOTACTIVE').'/customer/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set Unapproved" data-url=""  style="text-decoration: none;">remove_circle</a>
													<?php else: ?>
														<a href="<?php echo e(URL::to('user/'.Helper::encode($usersList->id).'/'.env('ACTIVE').'/customer/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-danger" data-toggle="tooltip" title="Set Approved" data-url=""  style="text-decoration: none;">check_circle</a>
													<?php endif; ?>
												<?php endif; ?>
												
												<a href="#" type="button" class="material-icons js-sweetalert waves-effect btn btn-danger" data-type="delete" data-toggle="tooltip" title="delete" data-url="user/<?php echo e($usersList->id); ?>/delete"  style="text-decoration: none;">delete_forever</a>
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