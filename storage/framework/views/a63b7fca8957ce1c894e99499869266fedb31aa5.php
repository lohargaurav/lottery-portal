<form name="frmEditUnit" id="frmEditUnit" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
	<input type="hidden" name="editId" value="<?php echo e($commodity_details->id); ?>" /> 
	<div class="col-sm-12">
		<label for="commodity_name">Commodity Name</label>
		<div class="form-group">
			<div class="form-line">
				<input type="text" id="commodity_name" class="form-control" placeholder="Enter commodity name" name="commodity_name" value="<?php echo e($commodity_details->cName); ?>" required>
			</div>
		</div>
	</div>
		
	<div class="col-sm-12">	 
		<label for="commodity_name">Commodity Image</label>
		<div class="form-group">
			<img src="<?php echo e($commodity_details->image); ?>" onerror="this.src='<?php echo e(env('API_URL').'uploads/default.png'); ?>'" width="100" height="120">
		</div>
		<div class="form-group">
			<div class="form-line">
				<input type="file" id="commodity_image" class="form-control" name="commodity_image">
			</div>
		</div>
	</div>
		
		 
	<div class="col-sm-12">	
		<div class="form-group">
			<input type="radio" name="commodity_status" id="active" class="with-gap" value="1" <?php if($commodity_details->status==1): ?> checked="checked" <?php else: ?> checked="" <?php endif; ?>>
			<label for="active">Active</label>

			<input type="radio" name="commodity_status" id="de-active" class="with-gap"  value="0"  <?php if($commodity_details->status==0): ?> checked="checked" <?php else: ?> checked="" <?php endif; ?>>
			<label for="de-active" class="m-l-20">De-active</label>
		</div>
	</div> 
   	  
</form>
