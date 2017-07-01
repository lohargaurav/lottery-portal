<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{env('TITLE')}} Sign In</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('public/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('public/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('public/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('public/css/style.css')}}" rel="stylesheet">
	
</head>

<body class="theme-red">
  <section class="content">
    <div class="container-fluid">
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header ">
						<h2 class="pull-left">
							Register franchisee
						</h2>							
					</div>
					<div class="body">
						<form name="frmAddData" id="frmAddData" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />		
							<input type="hidden" name="role" value="{{env('FRANCHISEE')}}" />		
							<label for="fullname">Full Name</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="fullname" class="form-control" placeholder="Enter full name" name="fullname" required>
								</div>
							</div>
							
							<label for="address">Address</label>
							<div class="form-group">
								<div class="form-line">
									<textarea id="address" class="form-control" placeholder="Enter address" name="address" required>
									</textarea>
								</div>
							</div> 
							
							<label for="mobile">Mobile</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="mobile" class="form-control" placeholder="Enter mobile" name="mobile" required>
								</div>
							</div>
							
							<label for="email">Email</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="email" class="form-control" placeholder="Enter email" name="email" required>
								</div>
							</div>
							
							<label for="username">Username</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" id="username" class="form-control" placeholder="Enter username" name="username" required>
								</div>
							</div>
							
							<label for="password">Password</label>
							<div class="form-group">
								<div class="form-line">
									<input type="password" id="password" class="form-control" placeholder="Enter password" name="password" required>
								</div>
							</div>
							
							<label for="confirm_password">Confirm Password</label>
							<div class="form-group">
								<div class="form-line">
									<input type="password" id="confirm_password" class="form-control" placeholder="Enter confirm password" name="confirm_password" required>
								</div>
							</div>
							
							<label for="profile_image">Profile Image</label>							
							<div class="form-group">
								<div class="form-line">
									<input type="file" id="profile_image" class="form-control" name="profile_image">
								</div>
							</div>
							
							<div class="form-group">
								<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAdd" data-url="add_franchisee" data-frmid="#frmAddData">SAVE</button>
								<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
							</div>
						</form>	 
						
					</div>
				</div>
			</div>
		</div>	
	</div>	
				
</section>
    <!-- Jquery Core Js -->
    <script src="{{asset('public/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('public/plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('public/plugins/node-waves/waves.js')}}"></script>

    
    <!-- Custom Js -->
    <script src="{{asset('public/js/admin.js')}}"></script>
	<script src="{{asset('public/js/app.js')}}"></script>
    <script>
		$('#rememberme').click(function() { 
		if($(this).is(':checked')) 
			$('#rememberme').val('1'); 
		else 
			$('#rememberme').val('0'); 
		});
    </script>
</body>

</html>