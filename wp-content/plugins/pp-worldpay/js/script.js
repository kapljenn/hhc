(function ($) {
	
jQuery(document).ready(function() {

	$('.pp-set-amount').click(function(){
		$('.pp-worldpay-amount').val($(this).data('pp-amount'));
	});

});

}(jQuery));

    window.onload = function() {
      Worldpay.useTemplateForm({
        'clientKey':'T_C_a43d9548-390a-42ca-b0b6-8dddc15a7c71',
        'form':'paymentForm',
        'paymentSection':'paymentSection',
        'display':'inline',
        'reusable':true,
        'callback': function(obj) {
          if (obj && obj.token) {
            var _el = document.createElement('input');
            _el.value = obj.token;
            _el.type = 'hidden';
            _el.name = 'token';
            document.getElementById('paymentForm').appendChild(_el);
            document.getElementById('paymentForm').submit();
          }
        }
      });
    }