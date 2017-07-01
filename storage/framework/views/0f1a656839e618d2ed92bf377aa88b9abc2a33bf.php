<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To TFS</title>
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
	
	<!-- Light Gallery Plugin Css -->
    <link href="<?php echo e(asset('public/plugins/light-gallery/css/lightgallery.css')); ?>" rel="stylesheet">
	
	<!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('public/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />
	
    <!-- Preloader Css -->
    <link href="<?php echo e(asset('public/plugins/material-design-preloader/md-preloader.css')); ?>" rel="stylesheet" />
	
	 <!-- Sweetalert Css -->
    <link href="<?php echo e(asset('public/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet" />
	
	<!-- JQuery DataTable Css -->
    <link href="<?php echo e(asset('public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')); ?>" rel="stylesheet">
	
    <!-- Morris Chart Css-->
    <link href="<?php echo e(asset('public/plugins/morrisjs/morris.css')); ?>" rel="stylesheet" />
	
	<!-- Bootstrap Material Datetime Picker Css -->
    <link href="<?php echo e(asset('public/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="<?php echo e(asset('public/plugins/waitme/waitMe.css')); ?>" rel="stylesheet" />
	
	<!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('public/plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet" />
	
    <!-- Custom Css -->
    <link href="<?php echo e(asset('public/css/style.css')); ?>" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo e(asset('public/css/themes/all-themes.css')); ?>" rel="stylesheet" />
	
	<!-- Dropzone Css -->
    <link href="<?php echo e(asset('public/plugins/dropzone/dropzone.css')); ?>" rel="stylesheet" />

	 
	
	<style>
	.mrg{margin-top:0px;}
	</style>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <!--div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div-->
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo e(URL::to('/home')); ?>">ADMIN - <?php echo e(env('PROJECT_SHORT_NAME')); ?></a>
            </div>
            <!--div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">       
                    
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div-->
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?php echo e(asset('public/images/user.png')); ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></div>
                    <div class="email"><?php echo e(Auth::user()->email); ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="#" data-toggle="modal" data-target="#ResetPasswordModal" ><i class="material-icons">lock_open</i>Reset Password</a></li>
                            <!--li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li-->
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?php echo e(URL::to('/logout')); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li <?php if(Request::url() == URL::to('/home')): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo e(URL::to('/home')); ?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Manage Users</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if(Request::url() == URL::to('trader')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('trader')); ?>">Traders</a>
                            </li>
                            <li <?php if(Request::url() == URL::to('broker')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('broker')); ?>">Brokers</a>
                            </li>
                            <li <?php if(Request::url() == URL::to('logistics')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('logistics')); ?>">Logistics</a>
                            </li>
							 <li <?php if(Request::url() == URL::to('procurement')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('procurement')); ?>">Procurement Companies</a>
                            </li>
							<li <?php if(Request::url() == URL::to('farmer')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('farmer')); ?>">Farmers</a>
                            </li>
                        </ul>
                    </li>
 
                    <li>
						<a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>Manage Masters</span>
                        </a>
						<ul class="ml-menu">
							<li <?php if(Request::url() == URL::to('commodity')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('commodity')); ?>">Commodities</a>
                            </li>
							<li <?php if(Request::url() == URL::to('parameters')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('parameters')); ?>">Commodity Parameters</a>
                            </li>							
							<li <?php if(Request::url() == URL::to('markets')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('markets')); ?>">Markets</a>
                            </li>
							<li <?php if(Request::url() == URL::to('plans')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('plans')); ?>">Plans</a>
                            </li>
							<li <?php if(Request::url() == URL::to('roles')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('roles')); ?>">Roles</a>
                            </li>
							<li <?php if(Request::url() == URL::to('units')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('units')); ?>">Units</a>
                            </li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings</i>
                            <span>Manage Content</span>
                        </a>
						<ul class="ml-menu">
							<li <?php if(Request::url() == URL::to('advertisements')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('advertisements')); ?>">Advertisements</a>
                            </li>
							<li <?php if(Request::url() == URL::to('news')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(URL::to('news')); ?>">News</a>
                            </li>							
							
						</ul>
					</li>
 
                
                    
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 <a href="javascript:void(0);"></a>.
                </div>
                <!--div class="version">
                    <b>Version: </b> 1.0.3
                </div-->
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
       
    </section>
	
   <?php echo $__env->yieldContent('content'); ?>
    <!-- Modal Dialogs -->
	<!-- Default Size -->
	<div class="modal fade" id="ResetPasswordModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Reset Password</h4>
				</div>
				<div class="modal-body">
					<form name="frmAddResetPassword" id="frmAddResetPassword" enctype="multipart/form-data">
					 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
					<div class="col-sm-12">
						<label for="npassword">New Password</label>
						<div class="form-group form-group1">
							<div class="form-line">
								<input type="password" id="npassword" name="npassword" class="form-control" placeholder="Enter new password" >
							</div>
						</div>
					</div>
					
					<div class="col-sm-12">
						<label for="cpassword">Confirm Password </label>
						<div class="form-group form-group1">
							<div class="form-line">
								<input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Enter confirm password" >
							</div>
						</div>
					</div>
						</form>
				
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link waves-effect add_data" data-url="reset_password" data-frmid="#frmAddResetPassword" data-modalname="#ResetPasswordModal" id="btndefaultModal" >SAVE CHANGES</button>
					<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
				</div>
			</div>
		</div>
	</div>
   <!-- Jquery Core Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery/jquery.min.js')); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/bootstrap/js/bootstrap.js')); ?>"></script>
	
    <!-- Select Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/bootstrap-select/js/bootstrap-select.js')); ?>"></script>
	
    <!-- Slimscroll Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-slimscroll/jquery.slimscroll.js')); ?>"></script>
	
    <!-- Waves Effect Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/node-waves/waves.js')); ?>"></script>
	<!-- Light Gallery Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/light-gallery/js/lightgallery-all.js')); ?>"></script>

    <!-- Custom Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/js/pages/medias/image-gallery.js')); ?>"></script>
	 <!-- Autosize Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/autosize/autosize.js')); ?>"></script>
	<!-- Moment Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/momentjs/moment.js')); ?>"></script>
	 <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('public/js/pages/forms/basic-form-elements.js')); ?>"></script>
	
	<!-- SweetAlert Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/sweetalert/sweetalert.min.js')); ?>"></script>
	<!-- MY LOGIC APP JS-->
	 <script type="text/javascript" src="<?php echo e(asset('public/js/app.js')); ?>"></script>
	  
	<!-- Jquery DataTable Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-datatable/jquery.dataTables.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')); ?>"></script>
    <!-- Morris Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/raphael/raphael.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/morrisjs/morris.js')); ?>"></script>

    
    <!-- Sparkline Chart Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-sparkline/jquery.sparkline.js')); ?>"></script>

   
	
	<script type="text/javascript" src="<?php echo e(asset('public/js/pages/tables/jquery-datatable.js')); ?>"></script>
    <!-- Demo Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/js/demo.js')); ?>"></script>
	
	<!-- Dropzone Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/dropzone/dropzone.js')); ?>"></script>
	<!-- Input Mask Plugin Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-inputmask/jquery.inputmask.bundle.js')); ?>"></script>
    <!-- Jquery Validation Plugin Css -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-validation/jquery.validate.js')); ?>"></script>
	
	 <!-- Custom Js -->
    <script type="text/javascript" src="<?php echo e(asset('public/js/admin.js')); ?>"></script>
	<script type="text/javascript">
		var count = 0;
		$('#container').on('click','.newField', function () {
			
			if(count<2){
					
					var newthing=$('div.addNew:first').clone().find('.newField').removeClass('newField').removeClass('btn-success').addClass('remove').addClass('btn-danger').text("").append('<i class="material-icons">clear</i>').end();
					//newthing.find("input[name^='c_date']").attr('id','c_date'+count);
					newthing.find('input').val("");
					
					$('#container').append(newthing);
					
					count++;
					
			}
			else{
				alert("only 3 time");
			}
		 
			 
		});
    
		$('#container').on('click','.remove', function () {

			$(this).parent().parent().remove();
			count--;
		});
	

   	
		$('body').on('focus',".datepicker_class", function(){
			//alert("hii");			
			  $(this).bootstrapMaterialDatePicker({
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
	});
	
	$('body').on('click',".isTop_class", function(){
   
		if($(this).prop("checked")) {
			 $(this).val(1);
		} else {
			$(this).val(0);
		}
	}); 

    </script>

	
</body>

</html>