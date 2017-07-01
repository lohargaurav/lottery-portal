<form name="frmEditUnit" id="frmEditUnit" enctype="multipart/form-data">
	 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
	 <input type="hidden" name="editId" value="<?php echo e($plan_master->id); ?>" />
	 <div class="col-sm-12">
		<label for="title">Title</label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="plan_title" name="plan_title" class="form-control" placeholder="Enter title" value="<?php echo e($plan_master->type); ?>">
			</div>
		</div>
	</div> 
	 
	<div class="col-sm-12">
		<label for="title">Price (<?php echo e(env('CURRENCY')); ?>)</label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="plan_price" name="plan_price" class="form-control" placeholder="Enter Price" value="<?php echo e($plan_master->price); ?>">
			</div>
		</div>
	</div> 

	<div class="form-group">
		<input type="radio" name="plan_status" id="active" class="with-gap" value="1" <?php if($plan_master->status==1): ?> checked="checked" <?php endif; ?>>
		<label for="active">Active</label>

		<input type="radio" name="plan_status" id="de-active" class="with-gap"  value="0"  <?php if($plan_master->status==0): ?> checked="checked" <?php endif; ?>>
		<label for="de-active" class="m-l-20">De-active</label>
 
	</div>
	  
</form>
				