<form name="frmEditAdvertisement" id="frmEditAdvertisement" enctype="multipart/form-data">
	 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
	 <input type="hidden" name="AdvertisementId" value="<?php echo e($objAdvertisement->id); ?>" />
	<div class="col-sm-12">
		<label for="title">Title</label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="edit_title" name="edit_title" class="form-control" placeholder="Enter title" value="<?php echo e($objAdvertisement->title); ?>" >
			</div>
		</div>
	</div>
	<div class="col-sm-12">
	   <label for="description">Description</label>
			<div class="form-group form-group1">
				<div class="form-line">
				  <textarea rows="2" class="form-control no-resize" id="edit_description" name="edit_description"  placeholder="Please type what you want..."> <?php echo e($objAdvertisement->description); ?></textarea>
				</div>
			</div>
	</div>
	<div class="col-sm-12">
		<label for="offer">Offer</label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="edit_offer" name="edit_offer" class="form-control" placeholder="Enter offer" value="<?php echo e($objAdvertisement->offer); ?>">
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<?php foreach($objAdvertisement_Images as $Advertisement): ?>
		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 imgclass" id="<?php echo e($Advertisement->id); ?>">
			<a href="#"  data-sub-html="">
				<img class="img-responsive thumbnail" src="<?php echo e($Advertisement->image_url); ?>" onerror="this.src='<?php echo e(env('API_URL').'uploads/default.png'); ?>'" >
			</a>

			<center>	
				<a href="#" type="button" class="material-icons js-sweetalert waves-effect btn btn-danger" data-type="delete-img" data-toggle="tooltip" title="delete forever" data-url="advertisements/<?php echo e($Advertisement->id); ?>/delete_img" data-divid="<?php echo e($Advertisement->id); ?>"  style="text-decoration: none;">delete_forever</a>
			</center>

		</div>
		<?php endforeach; ?>
		</div>
		<br>
		<div class="col-sm-12">
		<input type="file" name="edit_imageUrl[]"  id="edit_imageUrl" multiple>
	</div>
</form>
				