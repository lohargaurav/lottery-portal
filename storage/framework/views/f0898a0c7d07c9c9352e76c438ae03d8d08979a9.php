<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo e(env('TITLE')); ?> Sign In</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo e(asset('public/plugins/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo e(asset('public/plugins/node-waves/waves.css')); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo e(asset('public/plugins/animate-css/animate.css')); ?>" rel="stylesheet" />
	
	<!-- Sweetalert Css -->
    <link href="<?php echo e(asset('public/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet" />
	
    <!-- Custom Css -->
    <link href="<?php echo e(asset('public/css/style.css')); ?>" rel="stylesheet">
	
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><?php echo e(env('PROJECT_SHORT_NAME')); ?> Admin Login</a>
            <!--small>Admin BootStrap Based - Material Design</small-->
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" name="frmLogin" >
				<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                    <div id="msg_div" class="msg">
                            Please login with your Email and Password.
                        </div>
                    <div class="input-group form-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" id="username" placeholder="User Name">
                        </div>
                    </div>
                    <div class="input-group form-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                    </div>
					</form>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" id="btnLogin"  type="button">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                             <button type="button" data-toggle="modal" data-target="#defaultAddModal" title="Sign up" class="btn btn-success btn-md waves-effect waves-float "  >
								Sign up
							</button>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="<?php echo e(URL::to('forgot_password')); ?>" >Forgot Password?</a>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
	<!-- Register Franchisee -->
	<div class="modal fade" id="defaultAddModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Register Franchisee</h4>
				</div>
				<div class="modal-body">
					<form name="frmAddData" id="frmAddData" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />		
							<input type="hidden" name="role" value="<?php echo e(env('FRANCHISEE')); ?>" />		
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

							
							<label for="accountName">Account Holder Name</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" id="accountName" name="accountName" class="form-control" placeholder="Enter your account name" >
								</div>
							</div>
						
							<label for="accountNumber">Account Number</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" id="accountNumber" class="form-control" placeholder="Enter your account number" name="accountNumber" required >
								</div>
							</div>
						
							<label for="bankName">Bank Name</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" id="bankName" name="bankName" class="form-control" placeholder="Enter bank name">
								</div>
							</div>
						
							<label for="bankIFSC">Bank IFSC Code</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="text" id="bankIFSC" name="bankIFSC" class="form-control" placeholder="Enter bank IFSC code">
								</div>
							</div>
						
					</form>
				</div>
				<div class="modal-footer">
					
					<button type="button" class="btn btn-md btn-success waves-effect add_data" id="btnAdd" data-url="add_franchisee" data-frmid="#frmAddData" data-modalname="#defaultAddModal">SAVE</button>
					<button type="button" class="btn btn-md  btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
		
				</div> 
			</div>
		</div>
	</div>

    <!-- Jquery Core Js -->
    <script src="<?php echo e(asset('public/plugins/jquery/jquery.min.js')); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo e(asset('public/plugins/bootstrap/js/bootstrap.js')); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo e(asset('public/plugins/node-waves/waves.js')); ?>"></script>

    <!-- SweetAlert Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/sweetalert/sweetalert.min.js')); ?>"></script>
	
    <!-- Custom Js -->
    <script src="<?php echo e(asset('public/js/admin.js')); ?>"></script>
	<script src="<?php echo e(asset('public/js/app.js')); ?>"></script>
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