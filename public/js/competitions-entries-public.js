(function( $ ) {
	'use strict';

	 jQuery(document).ready(function($) {
		$(document).on('click', '#submit-entry-form #submit-entry-btn', function(e) {
			e.preventDefault();
	
			// Remove any previous validation errors
			clearValidationErrors();
			var isValid = validateForm();
	
			if (isValid) {
				$.ajax({
					type: 'post',
					url: ajax_object.ajax_url,
					data: {
						action: 'submit_entry',
						competition_id: $('#competition_id').val(),
						first_name: $('#first_name').val(),
						last_name: $('#last_name').val(),
						email: $('#email').val(),
						phone: $('#phone').val(),
						description: $('#description').val(),	
						// Pass nonce field
						submit_entry_nonce_field: $('#submit_entry_nonce_field').val()
					},
					success: function(response) {
						Swal.fire({
							icon: 'success',
							title: 'Success!',
							text: 'Entry submitted successfully!',
						});
		
						// Clear the form or perform other actions after a successful submission
						$('#submit-entry-form')[0].reset();
					}
				});
			}
		});
	
		// Function to perform client-side validation
		function validateForm() {
			var isValid = true;
	
			// Validate each field
			if ($('#first_name').val() === '') {
				markFieldAsInvalid($('#first_name'), 'Please enter the First Name.');
				isValid = false;
			}
	
			if ($('#last_name').val() === '') {
				markFieldAsInvalid($('#last_name'), 'Please enter the Last Name.');
				isValid = false;
			}
	
			if ($('#email').val() === '' || !isValidEmail($('#email').val())) {
				markFieldAsInvalid($('#email'), 'Please enter a valid Email.');
				isValid = false;
			}
	
			if ($('#phone').val() === '') {
				markFieldAsInvalid($('#phone'), 'Please enter the Phone number.');
				isValid = false;
			}else{
				var phoneNumber = $('#phone').val();
				if (!isPhoneNumberValid(phoneNumber)) {
					markFieldAsInvalid($('#phone'), 'Please enter a valid phone number.');
					isValid = false;
				}
			}
	
			if ($('#description').val() === '') {
				markFieldAsInvalid($('#description'), 'Please enter the Description.');
				isValid = false;
			}
	
			return isValid;
		}
	
		function isValidEmail(email) {
			var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			return emailRegex.test(email);
		}
	    function isPhoneNumberValid(phoneNumber) {
			return /^[0-9]+$/.test(phoneNumber);
		}
		function markFieldAsInvalid(field, errorMessage) {
			field.addClass('invalid-field');
			field.after('<div class="error-message">' + errorMessage + '</div>');
		}
	
		// Function to clear validation errors
		function clearValidationErrors() {
			$('.invalid-field').removeClass('invalid-field');
			$('.error-message').remove();
		}
	});

})( jQuery );
