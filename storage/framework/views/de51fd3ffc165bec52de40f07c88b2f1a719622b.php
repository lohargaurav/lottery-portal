<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
					<h2 class="pull-left">
						Advertisements
					</h2>
					<div class="icon-button-demo pull-right" style="margin-top:-23px;">
						<button type="button" data-toggle="modal" data-target="#defaultAddAdvertisementModal" title="Add Advertisement" class="btn btn-success btn-circle-lg waves-effect waves-circle waves-float "  style="margin-top:10px;margin-left:10px;">
								<i class="material-icons">add_circle</i>
							</button>
					</div>
					<br>
				</div>
				
				<div class="body">
					
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>                                        
										<th>Title </th>
										<th width="300px">Description</th>
										<th>Offer</th>										
										<th>Position</th>
										<th>Created At</th>
										<th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($objAdvertisement as $key => $Advertisement): ?>
										<tr>
											<td><?php echo e(++$key); ?></td>
											<td><?php echo e($Advertisement->title); ?></td>
											<td><?php echo e($Advertisement->description); ?></td>
											<td><?php echo e($Advertisement->offer); ?></td>
											<td><?php echo e($Advertisement->position); ?></td>
											<td><?php echo e($Advertisement->createdDate); ?></td>
											<td>
												<a href="#" data-toggle="tooltip" title="Edit" style="text-decoration: none;" class="btn btn-md btn-primary material-icons edit_data" id="btnAdvertisementEdit" data-url="<?php echo e(URL::to('advertisements/'.Helper::encode($Advertisement->id).'/edit')); ?>">mode_edit</a>
											
												<a href="#" data-url="<?php echo e(URL::to('advertisements/'.Helper::encode($Advertisement->id).'/view')); ?>" id="btnAdvertisementView"  data-toggle="tooltip" title="View" style="text-decoration: none;" class="material-icons waves-effect btn btn-primary data_view"  >visibility</a>
											
												<a href="#" type="button" class="material-icons js-sweetalert waves-effect  btn btn-md btn-danger" data-type="delete" data-toggle="tooltip" title="delete forever" data-url="advertisements/<?php echo e($Advertisement->id); ?>/delete"  style="text-decoration: none;">delete_forever</a>
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
<!-- Add  Advertisement -->
	<div class="modal fade" id="defaultAddAdvertisementModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Add Advertisement</h4>
				</div>
				<div class="modal-body">
					<form name="frmAddAdvertisement" id="frmAddAdvertisement" enctype="multipart/form-data">
						 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
						<div class="col-sm-12">
                            <label for="title">Title</label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="title" name="title" class="form-control" placeholder="Enter title" >
								</div>
							</div>
						</div>
						<div class="col-sm-12">
						   <label for="description">Description</label>
								<div class="form-group form-group1">
									<div class="form-line">
									  <textarea rows="2" class="form-control no-resize" id="description" name="description"  placeholder="Please type what you want..."></textarea>
									</div>
								</div>
						</div>
						<div class="col-sm-12">
                            <label for="offer">Offer</label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="offer" name="offer" class="form-control" placeholder="Enter Offer" >
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<input type="file" name="imageUrl[]"  id="imageUrl" multiple>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAddAdvertisement" data-url="advertisement_add" data-frmid="#frmAddAdvertisement" data-modalname="#defaultAddAdvertisementModal">SAVE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>
 <!-- View  Advertisement -->
	<div class="modal fade" id="defaultViewModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">View Advertisement</h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>
<!-- EDIT  Advertisement -->
	<div class="modal fade" id="defaultEditModel" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Edit Advertisement</h4>
				</div>
				<div class="modal-body">
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-md  btn-success waves-effect add_data" id="btnEditAdvertisement" data-url="advertisement_edit" data-frmid="#frmEditAdvertisement" data-modalname="#defaultEditAdvertisementModal">UPDATE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
				</div> 
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>