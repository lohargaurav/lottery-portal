<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
					<h2  class="pull-left">
						Plans
					</h2>
					<div class="icon-button-demo pull-right" style="margin-top:-23px;">
						<button type="button" data-toggle="modal" data-target="#defaultAddDataModal" title="Add Role" class="btn btn-success btn-circle-lg waves-effect waves-circle waves-float "  style="margin-top:10px;margin-left:10px;">
								<i class="material-icons">add_circle</i>
							</button>
					</div>
					<br>
				</div>
				
				<div class="body">
					
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Id</th>										
										<th>Name</th> 										
										<th>price</th> 										
										<th>Action</th>
										<!--<th>Created At</th>  
										<th>Updated At</th>-->
										
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($plans_lists as $plans_list): ?>
										<tr>
											<td><?php echo e($plans_list->id); ?></td>
											<td>
												<?php echo e($plans_list->type); ?>

											</td>											 	
											<td>
												<?php echo e($plans_list->price); ?> <?php echo e(env('CURRENCY')); ?>

											</td>
											<td>		
											
												<a href="#" data-toggle="tooltip" title="Edit" style="text-decoration: none;" class="btn btn-md btn-primary material-icons edit_data"  data-url="<?php echo e(URL::to('plans/'.Helper::encode($plans_list->id).'/edit')); ?>">mode_edit</a>
												
												<?php if($plans_list->status == env('ACTIVE')): ?>
											
													<a href="<?php echo e(URL::to('plans/'.Helper::encode($plans_list->id).'/'.env('NOTACTIVE').'/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set De-active" data-url=""  style="text-decoration: none;">remove_circle</a>
												<?php else: ?>
													<a href="<?php echo e(URL::to('plans/'.Helper::encode($plans_list->id).'/'.env('ACTIVE').'/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-danger" data-toggle="tooltip" title="Set Active" data-url=""  style="text-decoration: none;">check_circle</a>
												<?php endif; ?>
											</td>
											
											<!--<td><?php echo e($plans_list->createdDate); ?></td>
											<td><?php echo e($plans_list->updatedDate); ?></td>-->
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
<!-- Add  Role -->
 <div class="modal fade" id="defaultAddDataModal" tabindex="-1" unit="dialog">
		<div class="modal-dialog" unit="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Add Plan</h4>
				</div>
				<div class="modal-body">
					<form name="frmAddUnit" id="frmAddUnit" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
						<div class="col-sm-12">
                            <label for="title">Title</label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="plan_title" name="plan_title" class="form-control" placeholder="Enter title" >
								</div>
							</div>
						</div> 
						 
						<div class="col-sm-12">
                            <label for="title">Price (<?php echo e(env('CURRENCY')); ?>)</label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="plan_price" name="plan_price" class="form-control" placeholder="Enter Price" >
								</div>
							</div>
						</div> 
						
						<div class="form-group">
							<input type="radio" name="plan_status" id="active" class="with-gap" value="1">
							<label for="active">Active</label>

							<input type="radio" name="plan_status" id="de-active" class="with-gap"  value="0">
							<label for="de-active" class="m-l-20">De-active</label>
							
							
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAddRole" data-url="plan_add" data-frmid="#frmAddUnit" data-modalname="#defaultAddDataModal">SAVE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>
<!-- EDIT  Plan -->
	<div class="modal fade" id="defaultEditModel" tabindex="-1" unit="dialog">
		<div class="modal-dialog" unit="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Edit Plan</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md  btn-success waves-effect add_data" id="btnEdit" data-url="plan_edit" data-frmid="#frmEditUnit" data-modalname="#defaultEditModel">UPDATE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>	
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>