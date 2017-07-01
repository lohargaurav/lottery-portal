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
										<th>Short Name</th> 										
										<th>Value</th> 										
										<th>Action</th>
										<!--<th>Created At</th>  -->                                      
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($unit_masters as $unit_master): ?>
										<tr>
											<td><?php echo e($unit_master->id); ?></td>
											<td>
												<?php echo e($unit_master->name); ?>

											</td>											 	
											<td>
												<?php echo e($unit_master->shortName); ?>

											</td>
											<td>
												<?php echo e($unit_master->value); ?>

											</td>											
											<td>		
											
												<a href="#" data-toggle="tooltip" title="Edit" style="text-decoration: none;" class="btn btn-md btn-primary material-icons edit_data"  data-url="<?php echo e(URL::to('units/'.Helper::encode($unit_master->id).'/edit')); ?>">mode_edit</a>
												
												<?php if($unit_master->status == env('ACTIVE')): ?>
											
													<a href="<?php echo e(URL::to('units/'.Helper::encode($unit_master->id).'/'.env('NOTACTIVE').'/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set De-active" data-url=""  style="text-decoration: none;">remove_circle</a>
												<?php else: ?>
													<a href="<?php echo e(URL::to('units/'.Helper::encode($unit_master->id).'/'.env('ACTIVE').'/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-danger" data-toggle="tooltip" title="Set Active" data-url=""  style="text-decoration: none;">check_circle</a>
												<?php endif; ?>
											</td>
											
											<!--<td><?php echo e($unit_master->createdDate); ?></td>-->
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
					<h4 class="modal-title" id="defaultModalLabel">Add Unit</h4>
				</div>
				<div class="modal-body">
					<form name="frmAddUnit" id="frmAddUnit" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
						<div class="col-sm-12">
                            <label for="title">Title</label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="unit_title" name="unit_title" class="form-control" placeholder="Enter title" >
								</div>
							</div>
						</div> 
						
						<div class="col-sm-12">
                            <label for="title">Short Name</label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="unit_short" name="unit_short" class="form-control" placeholder="Enter Short name" >
								</div>
							</div>
						</div> 
						
						<div class="col-sm-12">
                            <label for="title">Value</label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="unit_value" name="unit_value" class="form-control" placeholder="Enter Value" >
								</div>
							</div>
						</div> 
						
						<div class="form-group">
							<input type="radio" name="unit_status" id="active" class="with-gap" value="1">
							<label for="active">Active</label>

							<input type="radio" name="unit_status" id="de-active" class="with-gap"  value="0">
							<label for="de-active" class="m-l-20">De-active</label>
							
							
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAddRole" data-url="unit_add" data-frmid="#frmAddUnit" data-modalname="#defaultAddDataModal">SAVE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>
<!-- EDIT  Unit -->
	<div class="modal fade" id="defaultEditModel" tabindex="-1" unit="dialog">
		<div class="modal-dialog" unit="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Edit Unit</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md  btn-success waves-effect add_data" id="btnEdit" data-url="unit_edit" data-frmid="#frmEditUnit" data-modalname="#defaultEditModel">UPDATE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>	
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>