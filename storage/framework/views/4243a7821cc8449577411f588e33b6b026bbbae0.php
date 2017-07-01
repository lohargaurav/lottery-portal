<?php $__env->startSection('content'); ?>
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header ">
					<h2 class="pull-left">
						View Product Detail
					</h2>
						<br>
				</div>
				
				<div class="body">
					<form name="frmProduct_img_edit" id="frmProduct_img_edit" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
						<input type="hidden" name="product_id" value="<?php echo e($objProducts->pId); ?>"/>
					 <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<a href="<?php if($objProducts->imageUrl_1 != ""): ?><?php echo e(env('API_URL'). $objProducts->imageUrl_1); ?> <?php else: ?> <?php echo e(env('API_URL').'uploads/default.png'); ?> <?php endif; ?>"  data-sub-html="">
								<img class="img-responsive thumbnail" src="<?php echo e(env('API_URL'). $objProducts->imageUrl_1); ?>" onerror="this.src='<?php echo e(env('API_URL').'uploads/default.png'); ?>'" >
							</a>
							
							   <input type="file" name="imageUrl_1" id="imageUrl_1">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<a href="<?php if($objProducts->imageUrl_2 != ""): ?><?php echo e(env('API_URL'). $objProducts->imageUrl_2); ?> <?php else: ?> <?php echo e(env('API_URL').'uploads/default.png'); ?> <?php endif; ?>" data-sub-html="">
								<img class="img-responsive thumbnail" src="<?php echo e(env('API_URL'). $objProducts->imageUrl_2); ?>" onerror="this.src='<?php echo e(env('API_URL').'uploads/default.png'); ?>'">
							</a>
							<input type="file" name="imageUrl_2" id="imageUrl_2">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<a href="<?php if($objProducts->imageUrl_3 != ""): ?><?php echo e(env('API_URL'). $objProducts->imageUrl_3); ?> <?php else: ?> <?php echo e(env('API_URL').'uploads/default.png'); ?> <?php endif; ?>" data-sub-html="">
								<img class="img-responsive thumbnail" src="<?php echo e(env('API_URL'). $objProducts->imageUrl_3); ?>" onerror="this.src='<?php echo e(env('API_URL').'uploads/default.png'); ?>'">
							</a>
							<input type="file" name="imageUrl_3" id="imageUrl_3">
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<a href="<?php if($objProducts->imageUrl_4 != ""): ?><?php echo e(env('API_URL'). $objProducts->imageUrl_4); ?> <?php else: ?> <?php echo e(env('API_URL').'uploads/default.png'); ?> <?php endif; ?>" data-sub-html="">
								<img class="img-responsive thumbnail" src="<?php echo e(env('API_URL'). $objProducts->imageUrl_4); ?>" onerror="this.src='<?php echo e(env('API_URL').'uploads/default.png'); ?>'">
							</a>
							<input type="file" name="imageUrl_4"  id="imageUrl_4">
							
						</div>
						<center>
						<button type="button" id="btnProduct_img_edit" name="btnProduct_img_edit" class="btn btn-primary waves-effect js-sweetalert" data-type="update_data" data-url="<?php echo e(URL::to('user/product_img_edit')); ?>" data-frmid="#frmProduct_img_edit">
                                    UPDATE
                                </button>
						</center>
                    </div>
					</form><hr>
					<div class="raw">
						<div class="col-lg-6">
							<p for="first_name" style="font-size:2em;"><i class="material-icons">nature</i>    <?php echo e($objProducts->pName); ?></p>
						</div>
						<div class="col-lg-6">
							<p for="first_name" style="font-size:1.5em;"><i class="material-icons">info_outline</i>    <?php echo e($objProducts->product_enquiry); ?> enquiries   <i class="material-icons">visibility</i> 100 Views  </p>
						</div>
					</div>
					<div class="clearfix"> </div>
					<div class="raw">
						<div class="col-lg-6">
							<p for="first_name" style="font-size:1.5em;">Rs.<?php echo e($objProducts->price); ?> / <?php echo e($objProducts->unit); ?>  &nbsp;&nbsp;&nbsp;&nbsp; <i class="material-icons">shopping_basket</i> <?php echo e($objProducts->qty); ?> <?php echo e($objProducts->unit); ?> </p>
						</div>
						<div class="col-lg-6">
							<p for="first_name" style="font-size:1.5em;"> <i class="material-icons">place</i> <?php echo e($objProducts->location); ?>    </p>
						</div>
					</div>
					
					
					<div class="raw">
						<div class="col-lg-12">
						<p for="first_name" style="font-size:1.5em;"><?php echo e($objProducts->pDesc); ?> </p>
						</div>
					</div>
					<div class="clearfix"> </div>
					<div class="raw alert alert-danger" style="padding:0px;">
						<center style="font-size:1.5em;">Specification <i class="material-icons pull-right" style="padding:2px;cursor:pointer;" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample">add_box</i></center>
						
					</div>
					<div class="collapse" id="collapseExample">
						<div class="well">
							<table class="table table-striped">
							
							<tbody>
								<?php foreach($objCommodity_Master as $Commodity_Master): ?>
								<tr>
									<?php if($Commodity_Master['type'] != 2): ?>
									<td scope="row" style="font-size:1.5em;"><?php echo e($Commodity_Master['name']); ?></td>
									<td style="font-size:1.5em;"><?php echo e($Commodity_Master['value']); ?> to <?php echo e($Commodity_Master['toValue']); ?></td>
									<?php else: ?>
										<td scope="row" style="font-size:1.5em;"><?php echo e($Commodity_Master['name']); ?>  <i class="material-icons">album</i> <?php echo e($Commodity_Master['selectedLabel']); ?></td>
										<td> </td>
									<?php endif; ?>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
                       
						</div>
					</div>
					<div class="raw">
						<div class="col-lg-12">
						<p for="first_name" style="font-size:1.5em;">Payment By &nbsp;&nbsp;&nbsp;&nbsp;  <i class="material-icons">credit_card</i> &nbsp;&nbsp;&nbsp;&nbsp; Within <?php echo e($objProducts->paymentInDays); ?> Days </p>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				</div>	
			</div>	
		</div>	
		</div>	
				
</section>
<!-- #END# Tabs With Icon Title -->

 
<?php $__env->stopSection(); ?> 

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>