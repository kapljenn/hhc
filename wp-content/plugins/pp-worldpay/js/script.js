(function ($) {
	
jQuery(document).ready(function() {

	$('.pp-set-amount').click(function(){
		$('.pp-worldpay-amount').val($(this).data('pp-amount'));
		$('html, body').animate({
			scrollTop: $('#donate-wp3').offset().top
		}, 500);
	});


var form = document.getElementById('paymentForm');
var ppClientKey = $('#pp-client-key').val();

	Worldpay.useOwnForm({
	  'clientKey': ppClientKey,
	  'form': form,
	  'reusable': false,
	  'callback': function(status, response) {
		document.getElementById('paymentErrors').innerHTML = '';
		if (response.error) {             
			$('html, body').animate({
				scrollTop: $('#paymentErrors').offset().top
			}, 500);
		  Worldpay.handleError(form, document.getElementById('paymentErrors'), response.error); 
		} else {
		  var token = response.token;
		  Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
		  form.submit();
		}
	  }
	});  



});

}(jQuery));


    


