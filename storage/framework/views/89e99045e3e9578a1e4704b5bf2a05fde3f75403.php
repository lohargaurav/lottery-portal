<form name="frmEditUnit" id="frmEditUnit" enctype="multipart/form-data">
	 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
	 <input type="hidden" name="editId" value="<?php echo e($unit_master->id); ?>" />
 
	<div class="col-sm-12">
		<label for="title">Title</label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="unit_title" name="unit_title" class="form-control" placeholder="Enter title" value="<?php echo e($unit_master->name); ?>">
			</div>
		</div>
	</div> 
	
	<div class="col-sm-12">
		<label for="title">Short Name</label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="unit_short" name="unit_short" class="form-control" placeholder="Enter Short name"  value="<?php echo e($unit_master->shortName); ?>">
			</div>
		</div>
	</div> 
	
	<div class="col-sm-12">
		<label for="title">Value</label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="unit_value" name="unit_value" class="form-control" placeholder="Enter Value" value="<?php echo e($unit_master->value); ?>">
			</div>
		</div>
	</div> 
	 
	<div class="form-group">
		<input type="radio" name="unit_status" id="active" class="with-gap" value="1" <?php if($unit_master->status==1): ?> checked="checked" <?php endif; ?>>
		<label for="active">Active</label>

		<input type="radio" name="unit_status" id="de-active" class="with-gap"  value="0"  <?php if($unit_master->status==0): ?> checked="checked" <?php endif; ?>>
		<label for="de-active" class="m-l-20">De-active</label>		
	</div>
</form>
				