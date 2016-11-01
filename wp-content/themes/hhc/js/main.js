(function ($) {
	
jQuery(document).ready(function() {

	/****************************************


	GENERAL FUNCTIONS 


	****************************************/

	// determine if this is a touch device
	var isTouch =  !!("ontouchstart" in window) || window.navigator.msMaxTouchPoints > 0;

	// determine screen width
	var w = $(window).width();

	/* window resize events */
	function resizeActions() {
	    var w = $(window).width();

	    // MOBILE
	    if (w <= 767) {
	    }

	    // TABLET
	    else if (w <= 1023) {
	    }

	    // DESKTOP
	    else {
	    }
	};
	var resizeTimer;
	$(window).resize(function() {
	    clearTimeout(resizeTimer);
	    resizeTimer = setTimeout(resizeActions, 100);
	});
	resizeActions();

	// validate email addresses
	function validateEmail(email) {
	    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    return re.test(email);
	}

	// control numerical input fields
	$('input[type=number]').keypress(function(e) {
		var charCode = (e.which) ? e.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
	    return true;
	})

	// auto expand textarea height
	$('body').on( 'keyup', 'textarea', function () {
	    $(this).height(this.scrollHeight-40); // vertical padding
	});





	// make images fill their container, centered (using ImagesLoaded and ImageFill libraries)
	$('.img-holder').imagefill(); 






	// contact form validation
	$('.contact-form').submit(function(e) {

	    // prevent form being submitted using the normal handler
		e.preventDefault();

		// validation flag
		var formIsValid = true;

		// validate name
		if ($('input[name=the_name]').val() == "") {
			$('input[name=the_name]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('input[name=the_name]').parent().removeClass('error');
		}

		// validate email
		if ($('input[name=email]').val() == "") {
			$('input[name=email]').parent().addClass('error');
			formIsValid = false;
		} else if (!validateEmail($('input[name=email]').val())) {
			$('input[name=email]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('input[name=email]').parent().removeClass('error');
		}
		
		// validate phone
		if ($('input[name=phone]').val() == "") {
			$('input[name=phone]').parent().addClass('error');
			formIsValid = false;
		} else if ($('input[name=phone]').val().length < 10) {
			$('input[name=phone]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('input[name=phone]').parent().removeClass('error');
		}
		
		// validate message
		if ($('textarea[name=message]').val() == "") {
			$('textarea[name=message]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('textarea[name=message]').parent().removeClass('error');
		}
		
		var request;
		if (formIsValid) {

		    // serialise form data
		    var form = $(this);
		    var inputs = form.find("input, select, button, textarea");
		    var sfd = form.serialize();

			// disable the inputs
		    inputs.prop("disabled", true);

		    // hide the status message if it was already showing
			$('.submission-result').slideUp();

		    // show loader
		    $('.form-overlay').show();

		    // abort any pending request
		    if (request) request.abort();

		    // AJAX request
			request = $.ajax({
				url: ajax_url,
				type: 'post',
				data:{
					'action': 'do_ajax',
					'sfd': sfd
				},
			});

			// AJAX success
			request.done(function(response, textStatus, jqXHR) {
				//console.log(response);

				// unserialise the array
				response = jQuery.parseJSON(response);

				// style and show status message
				if  (response.status == "Error") $('.submission-result').addClass('error');
				else $('.submission-result').removeClass('error');
				$('.submission-result').text(response.message);
				$('.submission-result').slideDown();
			});

			// AJAX failure
			request.fail(function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			});

			// AJAX completion (success or failure)
			request.always(function() {

				// enable the inputs
			    inputs.prop("disabled", false);

			    // hide the loader
		    	$('.form-overlay').hide();
			});
		}
	});







	// register form validation
	$('.registration-form input[type=submit]').click(function(e) {

		// validation flag
		var formIsValid = true;

		// validate username
		if ($('input[name=username]').val() == "") {
			$('input[name=username]').parent().addClass('error');
			formIsValid = false;
		} else if ($('input[name=username]').val().length < 5) {
			$('input[name=username]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('input[name=username]').parent().removeClass('error');
		}

		// validate email
		if ($('input[name=email]').val() == "") {
			$('input[name=email]').parent().addClass('error');
			formIsValid = false;
		} else if (!validateEmail($('input[name=email]').val())) {
			$('input[name=email]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('input[name=email]').parent().removeClass('error');
		}
		
		// validate password
		if ($('input[name=password]').val() == "") {
			$('input[name=password]').parent().addClass('error');
			formIsValid = false;
		} else if ($('input[name=password]').val().length < 8) {
			$('input[name=password]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('input[name=password]').parent().removeClass('error');
		}

		// validate password2
		if ($('input[name=password2]').val() == "") {
			$('input[name=password2]').parent().addClass('error');
			formIsValid = false;
		} else if ($('input[name=password]').val() != $('input[name=password2]').val()) {
			$('input[name=password2]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('input[name=password2]').parent().removeClass('error');
		}

		// validate checkbox
		if ($('input[name=agree]:checked').length < 1) {
			console.log("hi");
			$('input[name=agree]').parent().addClass('error');
			formIsValid = false;
		} else {
			console.log("no");
			$('input[name=agree]').parent().removeClass('error');
		}

		if (formIsValid) {

		    // show loader
		    $('.form-overlay').show();

		    // submit form
		    $('.register-form').submit();

		} else e.preventDefault();

	});









	// login form validation
	$('.login-form input[type=submit]').click(function(e) {

		// validation flag
		var formIsValid = true;

		// validate username
		if ($('input[name=log]').val() == "") {
			$('input[name=log]').parent().addClass('error');
			formIsValid = false;
		} else if ($('input[name=log]').val().length < 5) {
			$('input[name=log]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('input[name=log]').parent().removeClass('error');
		}

		// validate password
		if ($('input[name=pwd]').val() == "") {
			$('input[name=pwd]').parent().addClass('error');
			formIsValid = false;
		} else if ($('input[name=pwd]').val().length < 8) {
			$('input[name=pwd]').parent().addClass('error');
			formIsValid = false;
		} else {
			$('input[name=pwd]').parent().removeClass('error');
		}

		if (formIsValid) {

		    // show loader
		    $('.form-overlay').show();

		    // submit form
		    $('.login-form').submit();

		} else e.preventDefault();

	});








    // lost password form
    $(".lost-password-form").submit(function() {

        var contents = {
                action:     'lost_pass',
                nonce:         this.rs_user_lost_password_nonce.value,
                user_login:    this.user_login.value
            };
        
        $.post(ajax_url, contents, function(data) {
        	console.log(data);

        	if (data == "Please check your email for the password reset link.") {
        		$('.form-header').html(data).slideDown();
        		$('.form-element, input').slideUp();
        	} else {
        		$('#user_login').parent().find('.error-message').html(data);
        		$('#user_login').parent().addClass('error');
        	}
        });
        
        return false;
    });
    
    // reset password form
    $(".reset-password-form").submit(function() {
        var contents = {
                action:     'reset_pass',
                nonce:         this.rs_user_reset_password_nonce.value,
                pass1:        this.pass1.value,
                pass2:        this.pass2.value,
                user_key:    this.user_key.value,
                user_login:    this.user_login.value
            };
        
        $.post(ajax_url, contents, function(data) {
        	console.log(data);

        	if (data == "Your password has been reset.") {
        		$('.form-header').html(data).slideDown();
        		$('.form-element, input').slideUp();
        	} else if (data == "The passwords do not match.") {
        		$('#pass1').parent().removeClass('error');
        	} else {
        		$('#pass1, #pass2').parent().addClass('error');
        	}

            //$(".form-header").html(data);
            //$(".form-header").slideDown();
        });
        
        return false;
    });


















});

}(jQuery));









