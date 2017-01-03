(function ($) {
	
jQuery(document).ready(function() {

	$('.pp-set-amount').click(function(){
		$('.pp-worldpay-amount').val($(this).data('pp-amount'));
		$('html, body').animate({
			scrollTop: $('#donate-wp3').offset().top
		}, 500);
	});


 



});

}(jQuery));


    


