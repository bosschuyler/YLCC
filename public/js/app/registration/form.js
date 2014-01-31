jQuery(document).ready(function() {
	jQuery('#pre-register-form').validate({
		submitHandler: function(form) {
			form.submit();
		},
		errorClass: 'notice-area-error margin-top-small'
	});
	
	jQuery('#tour-date').datepicker();
});