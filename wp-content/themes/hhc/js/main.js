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
		while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css('borderTopWidth')) + parseFloat($(this).css('borderBottomWidth'))) {
			$(this).height($(this).height()+1);
		};
	});

	var qsRegex;
	var buttonFilter = '';
	var defaultFilter = '.initially-shown';
	
	var $grid;

	if ($('.publications-grid').length > 0) {
		console.log('p');
		$grid = $('.publications-grid').isotope({
			itemSelector: '.publication-grid-item',
			layoutMode: 'masonry',
			stagger: 100,
			filter: function() {
				if($('#quicksearch').val().length > 0)
				{
					return qsRegex ? $(this).text().match( qsRegex ) : true;
				}
				else if(buttonFilter != '')
				{
					return buttonFilter ? $(this).is( buttonFilter ) : true;
				}
				else
				{
					return defaultFilter ? $(this).is( defaultFilter ) : true;
				}
			}
		});
	}

	else if ($('.fundraising-tools-grid').length > 0) {
		console.log('ft');
		$grid = $('.fundraising-tools-grid').isotope({
			itemSelector: '.fundraising-tool-grid-item',
			layoutMode: 'masonry',
			stagger: 100,
			filter: function() {
				if($('#quicksearch').val().length > 0)
				{
					return qsRegex ? $(this).text().match( qsRegex ) : true;
				}
				else if(buttonFilter != '')
				{
					return buttonFilter ? $(this).is( buttonFilter ) : true;
				}
				else
				{
					return defaultFilter ? $(this).is( defaultFilter ) : true;
				}
			}
		});
	}

	$('#filters').on( 'click', 'button', function() {	
		qsRegex = '';
		$('#quicksearch').val('');
		if($(this).hasClass('is-checked'))
		{
			buttonFilter = '';
		}
		else
		{
			buttonFilter = $( this ).attr('data-filter');
		}
			
		$grid.isotope();
	});

	var $quicksearch = $('#quicksearch').keyup( debounce( function() {
		buttonFilter = '';
		$('.button-group').find('.is-checked').removeClass('is-checked');
		qsRegex = new RegExp( $quicksearch.val(), 'gi' );
		$grid.isotope();
	}) );


	$('.button-group').each( function( i, buttonGroup ) {
		var $buttonGroup = $( buttonGroup );
			$buttonGroup.on( 'click', 'button', function() {
			if($(this).hasClass('is-checked'))
			{
				$buttonGroup.find('.is-checked').removeClass('is-checked');
			}
			else
			{
				$buttonGroup.find('.is-checked').removeClass('is-checked');
				$( this ).addClass('is-checked');
			}
		});
	});
  
	function debounce( fn, threshold ) {
	  var timeout;
	  return function debounced() {
		if ( timeout ) {
		  clearTimeout( timeout );
		}
		function delayed() {
		  fn();
		  timeout = null;
		}
		setTimeout( delayed, threshold || 100 );
	  };
	}



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




	// make images fill their container, centered (using ImagesLoaded and ImageFill libraries)
	if (!isTouch) {
		// exclude Safari because it doesn't work well
		if ((navigator.userAgent.indexOf('Safari') != -1) && (navigator.userAgent.indexOf('Chrome') == -1)) {}
		else $('.img-holder').imagefill(); 
	}



	// Stripe label hack
	$('<div class="sc-form-group"><span class="contact-preferences">Opt in to receiving updates about how your donation is transforming lives</span></div>').insertBefore($('#contact_by_email').parent().parent());
	$('#contact_by_post').parent().parent().css('margin-top', '-37px');


	// font weight fix
	$('p').css('font-weight', '300');
	
	
	$('a').click(function(){
		if($(this).attr('href') == '#donate-wp1')
		{
			$('html, body').animate({
				scrollTop: $('#donate-wp1').offset().top
			}, 500);
			return false;
		}
	});

	if($('.thumbnails-equal-height').length)
	{
		var thumbHeight = 0;
		$('.thumbnails-equal-height').find('.thumbnail-link').each(function(){  
			if($(this).find('img').height() < thumbHeight || thumbHeight == 0)
			{  
				thumbHeight = $(this).find('img').height();  
			}
		});    
		$('.thumbnails-equal-height').find('.thumbnail-link').height(thumbHeight);	

		$( window ).resize(function() {
			var thumbHeight = 0;
			$('.thumbnails-equal-height').find('.thumbnail-link').each(function(){  
				if($(this).find('img').height() < thumbHeight || thumbHeight == 0)
				{  
					thumbHeight = $(this).find('img').height();  
				}
			});    
			$('.thumbnails-equal-height').find('.thumbnail-link').height(thumbHeight);	
		});		
	}


});

}(jQuery));









