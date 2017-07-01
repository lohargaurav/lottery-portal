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
						@if(Auth::user()->isAdmin)Franchisees @else Customers @endif List
					</h2>
						<br>
				</div>
				
				<div class="body">
					
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>                                        
										<th>Name</th>
										<th>Email</th>										
										<th>Phone No</th>
										<th>Address</th>										
										<th>Created at</th>
										<th>Actions</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
								
									@foreach($usersLists as $key => $usersList)
										<tr>
											<td>{{++$key}}</td>
											<td>{{$usersList->name}}</td>
											<td>{{$usersList->email}}</td>
											<td>{{$usersList->mobile}}</td>
											<td>{{$usersList->address}}</td>
											<td>{{$usersList->created_date}}</td>
											<td>
												<a href="{{URL::to('user/'.Helper::encode($usersList->id).'/view')}}" data-toggle="tooltip" title="View" style="text-decoration: none;" class="material-icons waves-effect btn btn-primary"  data-url="">visibility</a>
 
												
												
												@if(Auth::user()->isAdmin)
												
													@if($usersList->approved_by_admin == env('ACTIVE'))
												
														<a href="{{URL::to('user/'.Helper::encode($usersList->id).'/'.env('NOTACTIVE').'/franchisee/updateStatus')}}" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set Unapproved" data-url=""  style="text-decoration: none;">remove_circle</a>
													@else
														<a href="{{URL::to('user/'.Helper::encode($usersList->id).'/'.env('ACTIVE').'/franchisee/updateStatus')}}" type="button" class="material-icons waves-effect btn btn-danger" data-toggle="tooltip" title="Set Approved" data-url=""  style="text-decoration: none;">check_circle</a>
													@endif
												@else
													@if($usersList->approved_by_franchisee == env('ACTIVE'))
												
														<a href="{{URL::to('user/'.Helper::encode($usersList->id).'/'.env('NOTACTIVE').'/customer/updateStatus')}}" type="button" class="material-icons waves-effect btn btn-success" data-toggle="tooltip" title="Set Unapproved" data-url=""  style="text-decoration: none;">remove_circle</a>
													@else
														<a href="{{URL::to('user/'.Helper::encode($usersList->id).'/'.env('ACTIVE').'/customer/updateStatus')}}" type="button" class="material-icons waves-effect btn btn-danger" data-toggle="tooltip" title="Set Approved" data-url=""  style="text-decoration: none;">check_circle</a>
													@endif
												@endif
												
												<a href="#" type="button" class="material-icons js-sweetalert waves-effect btn btn-danger" data-type="delete" data-toggle="tooltip" title="delete" data-url="user/{{$usersList->id}}/delete"  style="text-decoration: none;">delete_forever</a>
											</td> 

										</tr>
									@endforeach
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
