<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>TFS Sign In</title>
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
                    <div class="input-group form-group1">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" id="username" placeholder="User Name">
                        </div>
                    </div>
                    <div class="input-group form-group1">
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
                            
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="<?php echo e(URL::to('forgot_password')); ?>">Forgot Password?</a>
                        </div>
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

    
    <!-- Custom Js -->
    <script src="<?php echo e(asset('public/js/admin.js')); ?>"></script>
	<script src="<?php echo e(asset('public/js/app.js')); ?>"></script>
    <script>
		$('#rememberme').click(function() { if($(this).is(':checked')) $('#rememberme').val('1'); else $('#rememberme').val('0'); });
    </script>
</body>

</html>