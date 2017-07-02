@extends('app')
@section('content')
<!-- Tabs With Icon Title -->
<section class="content">
    <div class="container-fluid">
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header ">
						<h2 class="pull-left">
							Credits History: 
						</h2>
						@if($objUser->id != Auth::user()->id)
						<div class="icon-button-demo pull-right">
							<button type="button" data-toggle="modal" data-target="#defaultAddModal" title="Add Points" class="btn btn-success btn-md waves-effect waves-float" >
								Transfer Points to Franchisee
							</button>
						</div>
						@endif
						<!-- Return points to admin-->
						@if(Auth::user()->role_id == env('FRANCHISEE'))
						<div class="icon-button-demo pull-right" >
							<button type="button" data-toggle="modal" data-target="#defaultReturnModal" title="Add Points" class="btn btn-success btn-md waves-effect waves-float" >
								Return Points to Admin
							</button>
						</div>
						
						<div class="icon-button-demo pull-right" >
							<button type="button" data-toggle="modal" data-target="#defaultRequestModal" title="Add Points" class="btn btn-success btn-md waves-effect waves-float" >
								Request Points from Admin
							</button>
						</div>
						@endif
						
						<br>
						
					</div>
					
					<div class="body">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<p class="font-bold">Name:  <span class="col-teal">{{$objUser->name}} </span></p>
							<p class="font-bold">Total Points: <span class="col-teal">{{$objCredits->points}} </span></p>
						</div>
						
						<!-- List Credits History -->
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>                                        
										<th>Description</th>
										<th>Cr.Points</th>
										<th>Dr.Points</th>
										<th>Reffrence</th>										
										<th>Date & Time</th>                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
								
								@if(isset($objCreditsHistory))
									@foreach($objCreditsHistory as $key => $value)
										<tr>
											<td>{{++$key}}</td>
											<td>{{$value->transaction_desc}}</td>
											@if($value->type==1)
											<td>{{$value->points_amt}}</td>
											<td>-</td>
											@else
											<td>-</td>	
											<td>{{$value->points_amt}}</td>
											@endif
											<td>{{$value->transaction_ref}}</td>
											<td>{{$value->created_date}}</td>
										</tr>
									@endforeach
								@endif
								</tbody>
								
					</div>					
				</div>	
			</div>	
		</div>	
	</div>			
				
</section>
<!-- #END# Tabs With Icon Title -->
<!-- Add   -->
<div class="modal fade" id="defaultAddModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Add Points</h4>
			</div>
			<div class="modal-body">
				<form name="frmAddData" id="frmAddData" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<input type="hidden" name="user_id" value="{{{ $objUser->id }}}" />
					 
					<div class="col-sm-12">
						<label for="credit_points">Ponits Amount</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="credit_points" name="credit_points" class="form-control" placeholder="Enter Amount" >
							</div>
						</div>
					</div>
					
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAdd" data-url="{{URL::to('credits_add')}}" data-frmid="#frmAddData" data-modalname="#defaultAddModal">SAVE</button>
				<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
			</div> 
		</div>
	</div>
</div>
<!-- Return points   -->
<div class="modal fade" id="defaultReturnModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Return Points</h4>
			</div>
			<div class="modal-body">
			<?php use App\Http\Controllers\HomeController;?>
				<form name="frmReturnData" id="frmReturnData" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<input type="hidden" name="user_id" value="<?php echo HomeController::getAdminId(); ?>" />
					 
					<div class="col-sm-12">
						<label for="credit_points">Ponits Amount</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="credit_points" name="credit_points" class="form-control" placeholder="Enter Amount" >
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAdd" data-url="{{URL::to('credits_add')}}" data-frmid="#frmReturnData" data-modalname="#defaultReturnModal">SUBMIT</button>
				<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
			</div> 
		</div>
	</div>
</div>
<!-- Request points-->
<div class="modal fade" id="defaultRequestModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Request Points</h4>
			</div>
			<div class="modal-body">
				<form name="frmRquestData" id="frmRquestData" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
					<div class="col-sm-12">
						<label for="credit_points">Ponits Amount</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" id="credit_points" name="credit_points" class="form-control" placeholder="Enter Amount" >
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAdd" data-url="{{URL::to('credits_request')}}" data-frmid="#frmRquestData" data-modalname="#defaultRequestModal">SUBMIT REQUEST</button>
				<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
			</div> 
		</div>
	</div>
</div>
 
@endsection 

