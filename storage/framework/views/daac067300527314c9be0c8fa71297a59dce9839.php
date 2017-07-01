<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
					<h2 class="pull-left">
						Markets
					</h2>
					<div class="icon-button-demo pull-right" style="margin-top:-23px;">
						<button type="button" data-toggle="modal" data-target="#defaultMarketAdvertisementModal" title="Add Market" class="btn btn-success btn-circle-lg waves-effect waves-circle waves-float "  style="margin-top:10px;margin-left:10px;">
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
										<th>Name</th>
										<th>Address</th>										
										<th>Created at</th>
										<th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($objMarket_Master as $key => $Market_Master): ?>
										<tr>
											<td><?php echo e(++$key); ?></td>
											<td><?php echo e($Market_Master->name); ?></td>
											<td><?php echo e($Market_Master->address); ?></td>
											<td><?php echo e(date('jS F Y',strtotime($Market_Master->createdDate))); ?></td>
											
											<td>
												<a href="#" data-toggle="tooltip" title="Edit" style="text-decoration: none;" class="btn btn-md btn-primary material-icons edit_data" id="btnMarketsEdit" data-url="<?php echo e(URL::to('markets/'.Helper::encode($Market_Master->id).'/edit')); ?>">mode_edit</a>
											
												<a href="#" data-toggle="tooltip" title="View" style="text-decoration: none;" class="material-icons btn btn-md btn-primary data_view" id="btnMarketsView"  data-url="<?php echo e(URL::to('markets/'.Helper::encode($Market_Master->id).'/view')); ?>">visibility</a>
											
												<a href="#" type="button" class="material-icons js-sweetalert waves-effect  btn btn-md btn-danger" data-type="delete" data-toggle="tooltip" title="delete forever" data-url="markets/<?php echo e($Market_Master->id); ?>/delete"  style="text-decoration: none;">delete_forever</a>
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

<!-- Add  Market -->
<div class="modal fade" id="defaultMarketAdvertisementModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Add Market</h4>
			</div>
			<div class="modal-body">
				<form name="frmAddMarket" id="frmAddMarket" enctype="multipart/form-data">
					 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
					<div class="col-sm-12">
						<label for="title">Market Name</label>
						<div class="form-group form-group1">
							<div class="form-line">
								<input type="text" id="name" name="name" class="form-control" placeholder="Enter name" >
							</div>
						</div>
					</div>
					
					<div class="col-sm-12">
						<label for="address">Location </label>
						<div class="form-group form-group1">
							<div class="form-line">
								<input type="text" id="address" name="address" class="form-control" placeholder="Enter address" >
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<label for="commodity">Commodity </label>
						<div class="form-group form-group1">
							<div class="form-line">
								<select class="form-control show-tick" data-live-search="true" name="commodity_master_name">
										<?php foreach($objCommodity_Master as $Commodity_Master): ?>
                                        <option value="<?php echo e($Commodity_Master->id); ?>"><?php echo e($Commodity_Master->cName); ?></option>
										<?php endforeach; ?>
                                    </select>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						
						<div class="form-group form-group1">
							<div class="form-line">
								
                                <input type="checkbox" id="md_checkbox_30" name="isTop" class="filled-in chk-col-green isTop_class" value="0"/>
                                <label for="md_checkbox_30"><b>isTop</b></label>
							</div>
						</div>
					</div>
					<div id="container">
					<div class="addNew">
						<div class="col-sm-4" >
							<label for="date">Date </label>
							<div class="form-group form-group1">
								<div class="form-line">
									
									<input type="text" id="c_date2" name="c_date[]" class="form-control datepicker_class" placeholder="Enter date" >
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<label for="price_amt_from">Price From </label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="price_amt_from" name="price_amt_from[]" class="form-control" placeholder="Enter price from" >
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<label for="price_amt_to ">Price To </label>
							<div class="form-group form-group1">
								<div class="form-line">
									<input type="text" id="price_amt_to" name="price_amt_to[]" class="form-control" placeholder="Enter price to" >
								</div>
							</div>
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-success waves-effect newField">
                                    <i class="material-icons">add</i>
                                </button>
						</div>
						 <br /><br />
        
				</div>
			</div>				
				</form>
				<div class="clearfix"></div> 
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAddMarket" data-url="markets_add" data-frmid="#frmAddMarket" data-modalname="#defaultMarketAdvertisementModal">SAVE</button>
				<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
			</div> 
		</div>
	</div>
</div>
 
 <!-- View  Market -->
<div class="modal fade" id="defaultViewModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">View Market</h4>
			</div>
			<div class="modal-body">
			
			</div>
			
			
			
			<div class="clearfix"></div> 
		</div>
	</div>
</div>

<!-- edit  Market -->
<div class="modal fade" id="defaultEditModel" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Edit Market</h4>
			</div>
			<div class="modal-body">
			
			</div>
			
			<div class="modal-footer">
		<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAddMarket" data-url="markets_edit" data-frmid="#frmEditMarket" data-modalname="#defaultEditMarketModal">SAVE</button>
				<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>

			</div> 
			
			<div class="clearfix"></div> 
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>