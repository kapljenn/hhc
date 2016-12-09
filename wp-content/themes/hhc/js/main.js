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






	// restore up/down arrow scrolling
	$(document).keydown(function(e) {

	    e.stopPropagation();
	    
	    switch(e.which) {

	    	// up arrow
	        case 38:
	        	console.log('up');
				var y = $(window).scrollTop(); 
				$("html, body").animate({ scrollTop: y - 100}, 200);
	        break;

	        // down arrow
	        case 40:
	        	console.log('down');
				var y = $(window).scrollTop(); 
				$("html, body").animate({ scrollTop: y + 100}, 200);
	        break;

	        default: return;
	    }
	});









});

}(jQuery));









