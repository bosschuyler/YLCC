jQuery(document).ready(function() {
	jQuery('#contact-form').validate({
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
});