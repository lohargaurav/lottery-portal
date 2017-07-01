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
						View Profile 
					</h2>
						<br>
				</div>
				
				<div class="body">
					<!-- Tabs With Icon Title -->
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active" >
							<a href="#profile_with_icon_title" data-toggle="tab" >
								<i class="material-icons">face</i> PERSONAL
							</a>
						</li>
						<li role="presentation">
							<a href="#messages_with_icon_title" data-toggle="tab" >
								<i class="material-icons">account_balance</i> BANK DETAILS
							</a>
						</li>

					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
						
							<p>
								<div class="raw">
									<div class="col-lg-5">
										 <img src="{{$objUser->profile_image}}" onerror="this.src='{{env('API_URL').'uploads/default.png'}}'" class="img-circle" alt="Cinque Terre" width="304" height="236"> 

									</div>
									<div class="col-lg-6">
										
										<p for="first_name" style="font-size:1.5em;"><i class="material-icons">person</i>  -  {{$objUser->name}}</p>
										<p for="company_name" style="font-size:1.5em;"><i class="material-icons">place</i>  -  {{$objUser->address}}</p>
										<p for="company_name" style="font-size:1.5em;"><i class="material-icons">phone_android</i>  -  {{$objUser->mobile}}</p>
										<p for="company_name" style="font-size:1.5em;"><i class="material-icons">mail</i>  -   {{$objUser->email}}</p>
										
										@if($objUser->role_id== env('FRANCHISEE'))
											<p for="franchisee_code" style="font-size:1.5em;"><i class="material-icons">launch</i>  -   {{$objUser->franchisee_code}}</p>
										@endif
			
										
									</div>
								</div>
                               
							
                                <div class="clearfix"> </div>
								                       
							</p>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
							<p>
								<div class="raw">
									<div class="col-lg-11">
										
										<p for="accountHolderName" style="font-size:1.5em;"><i class="material-icons">account_box</i> Account Holder  -  {{$objUser-> 	account_name}}</p>
										<p for="company_name" style="font-size:1.5em;"><i class="material-icons">label</i> Account Number  -  {{$objUser->account_number}}</p>
										<p for="company_name" style="font-size:1.5em;"><i class="material-icons">label</i> Bank Name  -  {{$objUser-> 	bank_name}}</p>
										<p for="company_name" style="font-size:1.5em;"><i class="material-icons">label</i> IFSC Code -   {{$objUser->ifsc_code}}</p>										
									</div>
								</div>
								<div class="clearfix"> </div
							</p>
						</div>
					</div>
                       
                    
            <!-- #END# Tabs With Icon Title -->
                 </div>
                    
					</div>
				</div>	
			</div>	
		</div>	
				
</section>
<!-- #END# Tabs With Icon Title -->

 
@endsection 
