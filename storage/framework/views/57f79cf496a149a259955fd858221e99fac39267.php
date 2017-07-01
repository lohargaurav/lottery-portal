<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
				
					<h2  class="pull-left">
						Commodity
					</h2>
					<div class="icon-button-demo pull-right" style="margin-top:-23px;">
						<button type="button" data-toggle="modal" data-target="#defaultAddDataModal" title="Add Commodity" class="btn btn-success btn-circle-lg waves-effect waves-circle waves-float "  style="margin-top:10px;margin-left:10px;">
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
										<th>Image</th>
										<th>Name</th> 										
										<th>Action</th>
										<!--<th>Created At</th>  -->                                      
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($commodity_masters as $key => $commodity_master): ?>
										<tr>
											<td><?php echo e(++$key); ?></td>
											<td>
												<img src="<?php echo e($commodity_master->image); ?>" onerror="this.src='<?php echo e(env('API_URL').'uploads/default.png'); ?>'" width="100" height="120">
											</td>
											<td><?php echo e($commodity_master->cName); ?></td>	
											<td>
												<a href="#" data-toggle="tooltip" title="Edit" style="text-decoration: none;" class="btn btn-md btn-primary material-icons edit_data"  data-url="<?php echo e(URL::to('commodity/'.Helper::encode($commodity_master->id).'/edit')); ?>">mode_edit</a>
												 
												
												<?php if($commodity_master->status == env('ACTIVE')): ?>
											
													<a href="<?php echo e(URL::to('commodity/'.Helper::encode($commodity_master->id).'/'.env('NOTACTIVE').'/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set De-active" data-url=""  style="text-decoration: none;">remove_circle</a>
												<?php else: ?>
													<a href="<?php echo e(URL::to('commodity/'.Helper::encode($commodity_master->id).'/'.env('ACTIVE').'/updateStatus')); ?>" type="button" class="material-icons waves-effect btn btn-danger" data-toggle="tooltip" title="Set Active" data-url=""  style="text-decoration: none;">check_circle</a>
												<?php endif; ?>
												
												<a href="#" type="button" class="material-icons js-sweetalert waves-effect btn btn-danger" data-type="delete" data-toggle="tooltip" title="Delete" data-url="commodity/<?php echo e(Helper::encode($commodity_master->id)); ?>/updateDelete"  style="text-decoration: none;">close</a>
												
											</td>
											
											<!--<td><?php echo e($commodity_master->createdDate); ?></td>-->
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
<!-- Add  Commodity -->
 <div class="modal fade" id="defaultAddDataModal" tabindex="-1" unit="dialog">
	<div class="modal-dialog" unit="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">New Commodity</h4>
				</div>
				<div class="modal-body">
					<form name="frmAddUnit" id="frmAddUnit" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />		
					<label for="commodity_name">Commodity Name</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" id="commodity_name" class="form-control" placeholder="Enter commodity name" name="commodity_name" required>
						</div>
					</div>
					
					 
					<label for="commodity_name">Commodity Image</label>
					
					<div class="form-group">
						<div class="form-line">
							<input type="file" id="commodity_image" class="form-control" name="commodity_image">
						</div>
					</div>
					
					 
					
					<div class="form-group">
						<input type="radio" name="commodity_status" id="active" class="with-gap" value="1">
						<label for="active">Active</label>

						<input type="radio" name="commodity_status" id="de-active" class="with-gap"  value="0">
						<label for="de-active" class="m-l-20">De-active</label>
					</div>
					
				</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAdd" data-url="commodity_add" data-frmid="#frmAddUnit" data-modalname="#defaultAddDataModal">SAVE</button>
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
					<h4 class="modal-title" id="defaultModalLabel">Edit Commodity</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md  btn-success waves-effect add_data" id="btnEdit" data-url="commodity_edit" data-frmid="#frmEditUnit" data-modalname="#defaultEditModel">UPDATE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>	
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>