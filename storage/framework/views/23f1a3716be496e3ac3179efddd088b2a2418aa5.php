<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
					<h2  class="pull-left">
						Roles
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
										<th>Action</th>
										<!--<th>Created At</th>  -->                                      
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($role_masters as $role_master): ?>
										<tr>
											<td><?php echo e($role_master->id); ?></td>
											<td>
												<?php echo e($role_master->role); ?>

											</td>
											 	
											<td>									 
												<a href="#" data-toggle="tooltip" title="Edit" style="text-decoration: none;" class="btn btn-md btn-primary material-icons edit_data"  data-url="<?php echo e(URL::to('roles/'.Helper::encode($role_master->id).'/edit')); ?>">mode_edit</a>
												
												<?php if($role_master->status == env('ACTIVE')): ?>
											
													<a href="<?php echo e(URL::to('roles/'.Helper::encode($role_master->id).'/'.env('NOTACTIVE').'/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set De-active" data-url=""  style="text-decoration: none;">remove_circle</a>
												<?php else: ?>
													<a href="<?php echo e(URL::to('roles/'.Helper::encode($role_master->id).'/'.env('ACTIVE').'/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-danger" data-toggle="tooltip" title="Set Active" data-url=""  style="text-decoration: none;">check_circle</a>
												<?php endif; ?>

												<?php if($role_master->canRemove == env('CANREMOVE')): ?>
													<a href="#" type="button" class="btn btn-md btn-danger material-icons js-sweetalert waves-effect" data-type="delete" data-toggle="tooltip" title="Remove" data-url="roles/<?php echo e(Helper::encode($role_master->id)); ?>/delete"  style="text-decoration: none;">delete_forever</a>
												<?php endif; ?>
											</td>
											
											<!--<td><?php echo e($role_master->createdDate); ?></td>-->
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
 <div class="modal fade" id="defaultAddDataModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Add Role</h4>
				</div>
				<div class="modal-body">
					<form name="frmAddRole" id="frmAddRole" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
						<div class="col-sm-12">
                            <label for="title">Title</label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="role_title" name="role_title" class="form-control" placeholder="Enter title" >
								</div>
							</div>
						</div> 
						<div class="form-group">
							<input type="radio" name="role_status" id="active" class="with-gap" value="1">
							<label for="active">Active</label>

							<input type="radio" name="role_status" id="de-active" class="with-gap"  value="0">
							<label for="de-active" class="m-l-20">De-active</label>
							
							
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAddRole" data-url="role_add" data-frmid="#frmAddRole" data-modalname="#defaultAddDataModal">SAVE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>
<!-- EDIT  Role -->
	<div class="modal fade" id="defaultEditModel" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Edit Role</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md  btn-success waves-effect add_data" id="btnEdit" data-url="role_edit" data-frmid="#frmEditRole" data-modalname="#defaultEditModel">UPDATE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>	
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>