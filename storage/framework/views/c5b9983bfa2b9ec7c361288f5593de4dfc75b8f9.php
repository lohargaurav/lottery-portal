<form name="frmEditMarket" id="frmEditMarket" enctype="multipart/form-data">
	 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
	 <input type="hidden" name="MarketId" value="<?php echo e($objMarket_Master->id); ?>" />
	<div class="col-sm-12">
		<label for="title">Market Name</label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="name_edit" name="name_edit" class="form-control" placeholder="Enter name" value="<?php echo e($objMarket_Master->name); ?>" >
			</div>
		</div>
	</div>
	
	<div class="col-sm-12">
		<label for="address">Location </label>
		<div class="form-group form-group1">
			<div class="form-line">
				<input type="text" id="address_edit" name="address_edit" class="form-control" placeholder="Enter address" value="<?php echo e($objMarket_Master->address); ?>">
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		<label for="commodity">Commodity </label>
		<div class="form-group form-group1">
			<div class="form-line">
				<select class="form-control show-tick" data-live-search="true" name="commodity_master_name_edit">
						<?php if(count($objMarket_Commodity_Master)==0): ?>
						<option value="">Select</option>
					<?php endif; ?>
						<?php foreach($objCommodity_Master as $Commodity_Master): ?>
							<option value="<?php echo e($Commodity_Master->id); ?>" <?php if(count($objMarket_Commodity_Master)!=0 && $Commodity_Master->id == $objMarket_Commodity_Master[0]->cId): ?> selected  <?php endif; ?>><?php echo e($Commodity_Master->cName); ?></option>
						<?php endforeach; ?>
					</select>
			</div>
		</div>
	</div>
	<div class="col-sm-12">
		
		<div class="form-group form-group1">
			<div class="form-line">
				
				<input type="checkbox" id="md_checkbox_30" name="isTop_edit" class="filled-in chk-col-green" <?php if($objMarket_Master->isTop == 1): ?> checked <?php endif; ?>  />
				<label for="md_checkbox_30"><b>isTop</b></label>
			</div>
		</div>
	</div>
	<div id="container">
		<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
	<thead>
		<tr>
			<th>Sr No.</th>                                        
			<th>Date </th>
			<th >Price From</th>
			<th >Price To</th>
			<th >Action</th>
		</tr>
	</thead>
	
	<tbody>
	<?php if(count($objMarket_Commodity_Master)!= 0): ?>
		<?php foreach($objMarket_Commodity_Master as $Market_Commodity_Master): ?>
			<tr id="<?php echo e($Market_Commodity_Master->id); ?>">
				<td><?php echo e($Market_Commodity_Master->id); ?></td>
				<td><?php echo e($Market_Commodity_Master->price_date); ?></td>
				<td><?php echo e($Market_Commodity_Master->price_amt_from); ?></td>
				<td><?php echo e($Market_Commodity_Master->price_amt_to); ?></td>
				<td><a href="#" type="button" class="material-icons js-sweetalert waves-effect" data-type="delete-dynamic" data-toggle="tooltip" title="delete forever" data-url="markets/<?php echo e($Market_Commodity_Master->id); ?>/delete_market_pricedate" data-divid="<?php echo e($Market_Commodity_Master->id); ?>"  style="text-decoration: none;">delete_forever</a></td>
				
			</tr>
		<?php endforeach; ?>
	 <?php else: ?>
		 <tr >
				<td colspan=5>No Records Found</td>
				
			</tr>
	<?php endif; ?>
	
	</tbody>
</table>
	</div>
	
<div id="container_edit">
	<div class="addNew1">
		<div class="col-sm-4" >
			<label for="date">Date </label>
			<div class="form-group form-group1">
				<div class="form-line">
					
					<input type="text" id="c_date_edit" name="c_date_edit[]" class="form-control datepicker_class" placeholder="Enter date" >
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<label for="price_amt_from">Price From </label>
			<div class="form-group form-group1">
				<div class="form-line">
					<input type="text" id="price_amt_from_edit" name="price_amt_from_edit[]" class="form-control" placeholder="Enter price from" >
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<label for="price_amt_to ">Price To </label>
			<div class="form-group form-group1">
				<div class="form-line">
					<input type="text" id="price_amt_to_edit" name="price_amt_to_edit[]" class="form-control" placeholder="Enter price to" >
				</div>
			</div>
		</div>
		<div class="col-sm-1">
			<button type="button" class="btn btn-success waves-effect newField1">
					<i class="material-icons">add</i>
				</button>
		</div>
		 <br />
<br />
</div>	
</div>	
</form>
				
<div class="clearfix"></div> 
<script>
//edit code
	$('#container_edit').on('click','.newField1', function () {
			
          var newthing=$('div.addNew1:first').clone().find('.newField1').removeClass('newField1').removeClass('btn-success').addClass('remove').addClass('btn-danger').text("").append('<i class="material-icons">clear</i>').end();
			newthing.find('input').val("");
         $('#container_edit').append(newthing);
		 
    });
    
     $('#container_edit').on('click','.remove', function () {
        
        $(this).parent().parent().remove();
    });
	
	if($( ".datepicker_class" ).length!=0){
		$('.datepicker_class').bootstrapMaterialDatePicker({			
			  // enable date picker
			  date : true, 
			  // enable time picker
			  time : false, 
			  // custom date format
			  format : 'YYYY-MM-DD', 

			  // min / max date
			  minDate : null, 
			  maxDate : null, 

			  // current date
			  currentDate : null, 

			  // Localization
			  lang : 'en', 

			  // week starts at
			  weekStart : 0, 

			  // short time format
			  shortTime : false, 

			  // text for cancel button
			  'cancelText' : 'Cancel', 

			  // text for ok button
			  'okText' : 'OK' 

			});
	}
</script>

