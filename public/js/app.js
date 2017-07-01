
function associate_errors(errors, $form) {
    $.each(errors, function (field, message) {
        var formGroup = $('[name=' + field + ']', $form).closest('.form-group');
        formGroup.addClass('has-error').append('<p class="help-block">' + message + '</p>');
    });
}
function resetModalFormErrors() {
    $('.form-group').removeClass('has-error');
    $('.form-group').find('.help-block').remove();
}
//ONLY NUMBER
$(document).on("keypress", '.only_number', function (e) {
//e.preventDefault();   
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});
//ONLY LETTERS
$(document).on("keypress", '.only_letter', function (e) {
//e.preventDefault();   
    //if the letter is not digit then display error and don't type anything
    if ((e.which > 47 && e.which < 58) && (e.which != 32)) {
        return false;
    }
});

//login
$(document).on("click", "#btnLogin", function (e) {
    e.preventDefault();
    var $form = $("#sign_in");
    $.ajax({
        type: "POST",
        url: "user_post_login",
        data: $("#sign_in").serialize(),
        success: function (msg) {
          if (msg.msg_status == "valid")
            {
                location.replace('home');
            }
            else
            {
                $("#msg_div").removeClass("alert-info").addClass("alert-danger");
                $("#msg_div").text(msg.message);
                $(".help-block").text("");
               
            }
        },
        error: function (response)
        {
           var errors = $.parseJSON(response.responseText);
            resetModalFormErrors();
            associate_errors(errors, $form);
        }
    });
});
//LOGIN ON ENTER BUTTON
$(document).on("keypress", "#btnLogin, #email, #password", function (e) {
     if(e.which == 13) {
         e.preventDefault();
   var $form = $("#sign_in");
    $.ajax({
        type: "POST",
        url: "user_post_login",
        data: $("#sign_in").serialize(),
        success: function (msg) {
           if (msg.msg_status == "valid")
            {
                location.replace('home');
            }
            else
            {
                $("#msg_div").removeClass("alert-info").addClass("alert-danger");
                $("#msg_div").text(msg.message);
				$(".help-block").text("");
            }
        },
        error: function (response)
        {
            var errors = $.parseJSON(response.responseText);
            resetModalFormErrors();
            associate_errors(errors, $form);
        }
    });
     }
    
});

$(document).on("click", '#btnOk', function (e) {
    e.preventDefault();
	//alert("jfgk");
    location.reload();
});

$(document).on("click", '#btnD-url', function (e) {
    e.preventDefault();
	var aurl = $(this).data('aurl');
    location.replace(aurl);
});

$(document).on("click", '.js-sweetalert', function () {
        var type = $(this).data('type');
        var aurl = $(this).data('url');
		//alert("hiii");
        if (type === 'delete') {
			swal({
				title: "Are you sure?",
				text: "Do you want to delete?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#dd4b39',
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
				}, function () {
					$.ajax({
						type: "GET",
						url: aurl,
						success: function (response) {
							swal("Deleted", response.message, "error");
							$(".confirm_ok").attr('id','btnOk');
							}
						});
				});
        }
		else if(type === 'update_data'){
				var frm = $(this).data('frmid')
				swal({
				title: "Are you sure?",
				text: "Do you want to Update?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#dd4b39',
				confirmButtonText: "Yes, update it!",
				closeOnConfirm: false,
				showLoaderOnConfirm: false,
			}, function () {

				
				var $form = $(frm)[0]; // You need to use standard javascript object here
				var formData = new FormData($form);
				$.ajax({
					type: "POST",
					url: aurl,
					data:formData,
					cache:false,
					processData: false, // Don't process the files
					contentType: false, // Set content type to false as jQuery will tell the server its a query string request
					success: function (response) {
							if(response.status==true){
							swal("Updated!",response.message, "success");
							$(".confirm_ok").attr('id','btnOk');}
							else
								swal("Error", response.message, "error");
						
					},
					error: function (response) {
						swal({
						  title: "Error!",
						  text: "Here's error message!",
						  type: "error",
						  timer: 000,
						  confirmButtonText: "OK"
						});
						var errors = $.parseJSON(response.responseText);
						resetModalFormErrors();
						associate_errors(errors, $form);
					}
				});


			});
		}
		else if(type === 'delete-dynamic'){
			var divId = $(this).data('divid')
			$.ajax({
					type: "GET",
					url: aurl,
					success: function (response) {
						
						  $("#"+divId).remove();
						  
						swal("Deleted", response.message, "error");
						
						
						}
					});
		}
});
//FORGOT PASSWORD
$(document).on("click", '.submit_data', function () {
	//alert('hiii');
	var frm = $(this).data('frmid');
	var aurl = $(this).data('url');
	var $form = $(frm);
	$.ajax({
		type: "POST",
		url: aurl,
		data: $form.serialize(),
		   beforeSend: function(){
			 $('.submit_data').attr("disabled", true);
		   },
		success: function (response) {
			if(response.msg_status == 'valid'){
				$('.msg').text(response.message).css('color','green');
			location.replace(response.durl);}
		    else{
				$('.submit_data').attr("disabled", false);
				$(".help-block").text("");
			$('.msg').text(response.message).css('color','red');}
		},
		error: function (response) {
			$('.msg').text("Enter your email address that you used to register. We'll send you an email with your username and password.").css('color','black');
			$('.submit_data').attr("disabled", false);
			var errors = $.parseJSON(response.responseText);
			resetModalFormErrors();
			associate_errors(errors, $form);
		}
	});
	
});

//DATA ADD 
$(document).on("click", '.add_data', function () {
	
	var aurl = $(this).data('url');
	var frm = $(this).data('frmid');
	var modalName = $(this).data('modalname');
	var $form = $(frm)[0]; // You need to use standard javascript object here
	var formData = new FormData($form);
	$.ajax({
		type: "POST",
		url: aurl,
		data:formData,
		cache:false,
		processData: false, // Don't process the files
		contentType: false, // Set content type to false as jQuery will tell the server its a query string request
		success: function (response) {
			if(modalName != ""){
			$(modalName).hide();
			
			if(aurl=="add_franchisee")
			{
				swal("Registered successfully!",response.message, "success");
			}else{
				swal("Added!",response.message, "success");	
			}
			
			$(".confirm_ok").attr('id','btnOk');
			}
			else{
				$(".confirm_ok").attr('id','btnD-url');
				$(".confirm_ok").attr('data-aurl',response.durl);
			}
		},
		error: function (response) {
			
			var errors = $.parseJSON(response.responseText);
			resetModalFormErrors();
			associate_errors(errors, $form);
		}
	});
	
});

// Edit Data Using Modal
 $(document).on("click", ".edit_data", function (e) {
    
    $.ajax({
        type: "GET",
        url: $(this).data('url'),
        success: function (response) {
			$('#defaultEditModel').modal();
			$('#defaultEditModel .modal-body').html(response);			
            
        }
    });
});

// View Data Using Modal
 $(document).on("click", ".data_view", function (e) {
    
    $.ajax({
        type: "GET",
        url: $(this).data('url'),
        success: function (response) {
			$('#defaultViewModal').modal();
			$('#defaultViewModal .modal-body').html(response);			
            
        }
    });
});




