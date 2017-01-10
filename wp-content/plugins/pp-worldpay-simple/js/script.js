(function ($) {
	
jQuery(document).ready(function() {

	$('.pp-set-amount').click(function(){
		$('.pp-worldpay-amount').val($(this).data('pp-amount'));
		$('html, body').animate({
			scrollTop: $('.gift-aid').offset().top
		}, 500);
	});


 



});

}(jQuery));


    


