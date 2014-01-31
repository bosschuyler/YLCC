jQuery(document).ready(function() {
	jQuery('#contact-form').validate({
		submitHandler: function(form) {
			form.submit();
		},
		errorClass: 'notice-area-error margin-top-small'
	});
});