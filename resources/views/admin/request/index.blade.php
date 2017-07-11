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
							@if(Auth::user()->isAdmin!=env('ISADMIN'))
								Customer Points Requests
							@else
								Franchisees Points Requests
							@endif
						</h2>
						<br>
					</div>
					
					<div class="body">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>                                        
										<th>Request By</th>
										<th>Points</th>										
										<th>Actions</th>                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
									@if(isset($objRequests))
										@foreach($objRequests as $key =>$value)
											<tr>
												<th>{{++$key}}</th>
												<th>{{$value->name}}</th>
												<th>{{$value->requested_points}}</th>
												<th>
												
													@if($value->isDelivered == env('ACTIVE'))
														<a href="#" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set Approved" data-url=""  style="text-decoration: none;">verified_user</a>
													@else													
														<a href="#" type="button" class="material-icons  js-sweetalert waves-effect btn btn-danger" data-toggle="tooltip" title="Set Unapproved" data-url="approveCreditsRequest/{{Helper::encode($value->id)}}"  style="text-decoration: none;" data-type="success">verified_user</a>
													@endif												
														<a href="#" type="button" class="material-icons js-sweetalert waves-effect btn btn-danger" data-type="delete" data-toggle="tooltip" title="delete" data-url="rejectCreditsRequest/{{$value->id}}"  style="text-decoration: none;">delete_forever</a>
												</th>
											</tr>
										@endforeach
									@endif
                                </tbody>
						</table>
					</div>
				</div>
			</div>	
		</div>	
	</div>	
				
</section>
<!-- #END# Tabs With Icon Title -->

 
@endsection 
