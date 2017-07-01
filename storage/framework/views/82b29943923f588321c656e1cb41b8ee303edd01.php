<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
					<h2 class="pull-left">
						News
					</h2>
					<div class="icon-button-demo pull-right" style="margin-top:-23px;">
                        <button type="button" data-toggle="modal" data-target="#defaultNewsModal" title="Add News" class="btn btn-success btn-circle-lg waves-effect waves-circle waves-float "  style="margin-top:10px;margin-left:10px;">
                                    <i class="material-icons">playlist_add</i>
                                </button>
						</div>
						<br>
				</div>
				
				<div class="body">
					
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>                                        
										<th>Title</th>
										<th>Short Description</th>										
										<th>Long Description</th>										
										<th>Created at</th>
										<th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($objNews as $News): ?>
										<tr>
											<td><?php echo e($News->id); ?></td>
											<td><?php echo e($News->title); ?></td>
											<td><?php echo e($News->short_description); ?></td>
											<td><?php echo e($News->long_description); ?></td>
											<td><?php echo e($News->created_at); ?></td>
											<td><a href="#" data-toggle="tooltip" title="Edit" style="text-decoration: none;" class="btn btn-md btn-primary material-icons edit_data" id="" data-url="<?php echo e(URL::to('news/'.Helper::encode($News->id).'/edit')); ?>">mode_edit</a>
											<!--a href="#" data-toggle="tooltip" title="View" style="text-decoration: none;" class="material-icons" id="btnMarketsView"  data-url="<?php echo e(URL::to('news/'.Helper::encode($News->id).'/view')); ?>">visibility</a-->
											<a href="#" type="button" class="material-icons js-sweetalert waves-effect  btn btn-md btn-danger" data-type="delete" data-toggle="tooltip" title="delete forever" data-url="news/<?php echo e($News->id); ?>/delete"  style="text-decoration: none;">delete_forever</a></td>
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

<!-- Add  Market -->
<div class="modal fade" id="defaultNewsModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Add News</h4>
			</div>
			<div class="modal-body">
				<form name="frmAddNews" id="frmAddNews" enctype="multipart/form-data">
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
						<label for="short_description">Short Description </label>
						<div class="form-group form-group1">
							<div class="form-line">
                                <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..." name="short_description" id="short_description"></textarea>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<label for="long_description">Long Description </label>
						<div class="form-group form-group1">
							<div class="form-line">
                                <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..." name="long_description" id="long_description"></textarea>
							</div>
						</div>
					</div>
				
					</form>
				<div class="clearfix"></div> 
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAddNews" data-url="news_add" data-frmid="#frmAddNews" data-modalname="#defaultNewsModal">SAVE</button>
				<button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
			</div> 
		</div>
	</div>
</div>
 
 
<!-- edit  News -->
<div class="modal fade" id="defaultEditModel" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Edit News</h4>
			</div>
			<div class="modal-body">
			
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnEditNews" data-url="news_edit" data-frmid="#frmEditNews" data-modalname="#defaultEditModel">Update</button>
				<button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
			</div> 
			
			<div class="clearfix"></div> 
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>