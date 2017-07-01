<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
					<h2 class="pull-left">
						Products (<?php echo e($ObjName->firstName); ?> <?php echo e($ObjName->lastName); ?>)
					</h2>
						<br>
				</div>
				
				<div class="body">
					<!-- Tabs With Icon Title -->
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active" >
							<a href="#profile_with_icon_title" data-toggle="tab" >
								<i class="material-icons">add_shopping_cart</i> BUY
							</a>
						</li>
						<li role="presentation">
							<a href="#messages_with_icon_title" data-toggle="tab" >
								<i class="material-icons">shopping_cart</i> SALE
							</a>
						</li>
						<!--li role="presentation">
							<a href="#network_with_icon_title" data-toggle="tab" >
								<i class="material-icons">device_hub</i> MY NETWORK
							</a>
						</li-->
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
						
							<p>
								<div class="raw">
									<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Product Id.</th>                                        
										<th>Name</th>
										<th>Commodity Name</th>
										<th>QTY</th>
										<th>Price</th>										
										<th>Unit</th>										
										<th>Enquiry / Contract Count</th>
										<th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($objProducts as $Products): ?>
										<?php if($Products->pType == env('FORBUY')): ?>
										<tr>
											<td><?php echo e($Products->id); ?></td>
											<td><?php echo e($Products->pName); ?></td>
											<td><?php echo e($Products->cName); ?></td>
											<td><?php echo e($Products->qty); ?></td>
											<td><?php echo e($Products->price); ?></td>
											<td><?php echo e($Products->unit); ?></td>
 
											<td><?php echo e($Products->product_enquiry); ?> / <?php echo e($Products->contract_count); ?></td>
											<td><!--a href="#" data-toggle="tooltip" title="Edit" style="text-decoration: none;" class="btn btn-md btn-primary material-icons edit_data" id="btndeliveryboyEdit" data-url="">mode_edit</a-->
											<a href="<?php echo e(URL::to('user/'.Helper::encode($Products->pId).'/product_detail')); ?>" data-toggle="tooltip" title="View" style="text-decoration: none;" class="material-icons waves-effect btn btn-primary"  data-url="">visibility</a>
											<!--a href="#" type="button" class="material-icons js-sweetalert waves-effect" data-type="delete" data-toggle="tooltip" title="delete forever" data-url="products/<?php echo e($Products->id); ?>/delete"  style="text-decoration: none;">delete_forever</a--></td>
 
										</tr>
										<?php endif; ?>
									<?php endforeach; ?>
                                </tbody>
                            </table>
                       
								</div>
                               
							
                                <div class="clearfix"> </div>
								                       
							</p>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
							
							<p>
							
								<div class="raw">
									<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Product Id.</th>                                        
										<th>Name</th>
										<th>Commodity Name</th>
										<th>QTY</th>
										<th>Price</th>										
										<th>Unit</th>										
										<th>Enquiry / Contract Count</th>
										<th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
									<?php foreach($objProducts as $Products): ?>
										<?php if($Products->pType == env('FORSALE')): ?>
										<tr>
											<td><?php echo e($Products->pId); ?></td>
											<td><?php echo e($Products->pName); ?></td>
											<td><?php echo e($Products->cName); ?></td>
											<td><?php echo e($Products->qty); ?></td>
											<td><?php echo e($Products->price); ?></td>
											<td><?php echo e($Products->unit); ?></td>
											<td><?php echo e($Products->product_enquiry); ?> / <?php echo e($Products->contract_count); ?></td>
											<td><a href="<?php echo e(URL::to('user/'.Helper::encode($Products->pId).'/product_detail')); ?>" data-toggle="tooltip" title="View" style="text-decoration: none;" class="material-icons"  data-url="">visibility</a>
											<!--a href="#" type="button" class="material-icons js-sweetalert waves-effect" data-type="delete" data-toggle="tooltip" title="delete forever" data-url="products/<?php echo e($Products->id); ?>/delete"  style="text-decoration: none;">delete_forever</a-->
											</td>
										</tr>
										<?php endif; ?>
									<?php endforeach; ?>
                                </tbody>
									
								</div>
								<div class="clearfix"> </div>
							
							</p>
						</div>
						
					</div>
                       
                    
            <!-- #END# Tabs With Icon Title -->
                 </div>
                    
					</div>
				</div>	
			</div>	
		</div>	
				
</section>
<!-- #END# Tabs With Icon Title -->

 
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>