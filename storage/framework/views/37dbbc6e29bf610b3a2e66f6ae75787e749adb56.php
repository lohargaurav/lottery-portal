<form name="frmEditRole" id="frmEditRole" enctype="multipart/form-data">
	 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
	 <input type="hidden" name="editId" value="<?php echo e($role_master->id); ?>" />
	 
	<div class="col-sm-12">
		<label for="title">Title</label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="role_title" name="role_title" class="form-control" placeholder="Enter title" value="<?php echo e($role_master->role); ?>">
			</div>
		</div>
	</div> 
	
	<div class="form-group">
		<input type="radio" name="role_status" id="active" class="with-gap" value="1" <?php if($role_master->status==1): ?> checked="checked" <?php endif; ?>>
		<label for="active">Active</label>

		<input type="radio" name="role_status" id="de-active" class="with-gap"  value="0"  <?php if($role_master->status==0): ?> checked="checked" <?php endif; ?>>
		<label for="de-active" class="m-l-20">De-active</label>		
	</div>
</form>
				