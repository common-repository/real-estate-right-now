jQuery(document).ready(function () {
	var messageDelay = 3000;
	jQuery("#realestaterightnow_sendMessage").click(function (evt) {
		evt.preventDefault();
		var realestaterightnow_contactForm = jQuery(this);
		var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
		var uemail = jQuery('#realestaterightnow_senderEmail').val();
		if (!jQuery('#realestaterightnow_senderName').val() || !jQuery('#realestaterightnow_senderEmail').val() || !jQuery('#realestaterightnow_sendermessage').val()) {
			jQuery('#realestaterightnow_incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
			realestaterightnow_contactForm.fadeOut().delay(messageDelay).fadeIn();
			// jQuery('#realestaterightnow_senderName').css('border', '1px solid red');
			return false;
		} else if (!re.test(uemail))
		{
			jQuery('#realestaterightnow_email_error').fadeIn().delay(messageDelay).fadeOut();
			return false;
		}
		var uname = jQuery('#realestaterightnow_senderName').val();
		var umessage = jQuery('#realestaterightnow_sendermessage').val();
		if (!onlyalpha(uname))
		{
			jQuery('#realestaterightnow_name_error').fadeIn().delay(messageDelay).fadeOut();
			return false;
		}
		/*
		        if( ! alphanumeric(umessage) )
		        {
		           jQuery('#realestaterightnow_message_error').fadeIn().delay(messageDelay).fadeOut();
		           return false; 
		        }
		 */
		umessage = sanitarize(umessage);
		//else {
		jQuery('#realestaterightnow_sendingMessage').fadeIn();
		realestaterightnow_contactForm.fadeOut();
		var nonce = jQuery('#_wpnonce').val();
		form_content = jQuery('#realestaterightnow_contactForm').serialize();
		jQuery.ajax({
			type: "POST",
			url: ajax_object.ajax_url,
			data: form_content + '&action=realestaterightnow_process_form' + '&security=' + _wpnonce,
			timeout: 20000,
			error: function (jqXHR, textStatus, errorThrown) {
				// alert('errorThrown');
				jQuery('#realestaterightnow_sendingMessage').hide();
				realestaterightnow_contactForm.fadeIn();
				alert('Fail to Connect with Data Base (9).\nPlease, try again later.');
			},
			success: submitFinished
		});
		// }
		return false;
	});
	jQuery(init_realestaterightnow_form);
	function init_realestaterightnow_form() {
		jQuery('#realestaterightnow_contactForm').hide(); //.submit( submitForm ).addClass( 'realestaterightnow_positioned' );
		jQuery('#realestaterightnow_sendingMessage').hide();
		jQuery('#realestaterightnow_successMessage').hide();
		jQuery('#realestaterightnow_failureMessage').hide();
		jQuery('#realestaterightnow_incompleteMessage').hide();
		jQuery("#realestaterightnow_cform").click(function () {
			jQuery('#realestaterightnow_cform').hide();
			jQuery('#realestaterightnow_contactForm').addClass('realestaterightnow_positioned');
			jQuery('#realestaterightnow_contactForm').css('opacity', '1');
			jQuery('#realestaterightnow_contactForm').fadeIn('slow', function () {
				jQuery('#realestaterightnow_senderName').focus();
			})
			return false;
		});
		// When the "Cancel" button is clicked, close the form
		jQuery('#realestaterightnow_cancel').click(function () {
			jQuery('#realestaterightnow_contactForm').fadeOut();
			jQuery('#content2').fadeTo('slow', 1);
			jQuery("#realestaterightnow_cform").fadeIn()
		});
		// When the "Escape" key is pressed, close the form
		jQuery('#realestaterightnow_contactForm').keydown(function (event) {
			if (event.which == 27) {
				jQuery('#realestaterightnow_contactForm').fadeOut();
				jQuery('#content2').fadeTo('slow', 1);
				jQuery("#realestaterightnow_cform").fadeIn()
			}
		});
	}
	function submitFinished(response) {
		response = jQuery.trim(response);
		jQuery('#realestaterightnow_sendingMessage').fadeOut();
		if (response == "success") {
			jQuery('#realestaterightnow_successMessage').fadeIn().delay(messageDelay).fadeOut();
			jQuery('#realestaterightnow_senderName').val("");
			jQuery('#realestaterightnow_senderEmail').val("");
			jQuery('#realestaterightnow_sendermessage').val("");
			jQuery('#content2').delay(messageDelay + 1000).fadeTo('slow', 1);
			jQuery('#realestaterightnow_contactForm').fadeOut();
			jQuery("#realestaterightnow_cform").fadeIn()
		} else {
			jQuery('#realestaterightnow_failureMessage').fadeIn().delay(messageDelay).fadeOut();
			jQuery('#realestaterightnow_contactForm').delay(messageDelay + 1000).fadeIn();
		}
	}
	function alphanumeric(inputtext)
	{
		if (/[^a-zA-Z0-9 ]/.test(inputtext)) {
			return false;
		}
		return true;
	}
	function sanitarize(str) {
		var map = {
			"&": "&amp;",
			"<": "&lt;",
			">": "&gt;",
			"\"": "&quot;",
			"\[": "&#91;",
			"\]": "&#93;",
			"\{": "&#123;",
			"\}": "&#125;",
			"'": "&#39;"}; // ' -> &apos; for XML only
			 return str.replace(/[&<>"\[\]\{\}']/g, function(m) { return map[m]; });
	}
	function onlyalpha(inputtext)
	{
		if (/[^a-zA-Z ]/.test(inputtext)) {
			return false;
		}
		return true;
	}
}); // end jQuery ready