jQuery(document).ready(function() {
	jQuery('#pre-register-form').validate({
		submitHandler: function(form) {
			form.submit();
		},
		errorClass: 'fail',
		errorElement: 'div',
		errorPlacement: function(error, element) {
			error.addClass('notice-area-error margin-bottom');
			element.parent("div").after(error);

		}
	});
	
	jQuery('#tour-date').datepicker();
});