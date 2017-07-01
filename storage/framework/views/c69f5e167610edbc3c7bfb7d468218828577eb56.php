<?php if(count($objAdvertisement)!= 0): ?>
<div class="raw">
	<p for="first_name" style="font-size:2em;"><i class="material-icons">brightness_1</i>    <?php echo e($objAdvertisement[0]->title); ?></p>
	<p><?php echo e($objAdvertisement[0]->description); ?></p>
</div>

<div id="aniimated-thumbnials" class="list-unstyled row clearfix">
	<?php foreach($objAdvertisement as $Advertisement): ?>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<a href="#"  data-sub-html="">
			<img class="img-responsive thumbnail" src="<?php echo e($Advertisement->image_url); ?>" onerror="this.src='<?php echo e(env('API_URL').'uploads/default.png'); ?>'" >
		</a>
		
		   
	</div>
	<?php endforeach; ?>
</div>
<?php else: ?>
<?php endif; ?>