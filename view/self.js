$(document).ready(function()
{
	// Gestion de la génération d'adresses personnelles
	$( "#edit_personnal_identifiant" ).on('change keyup', null, function() {
		
		new_personnal_url = false ;

		var valid = ( /^[a-zA-Z]*$/.test($(this).val()) && $(this).val().length > 0 ) ? true : false ;

		if (!valid) { 
			$(this).addClass('red-background');
			$('#keynote_add_button').attr('disabled', 'true');
		}
		else { 
			$(this).removeClass('red-background');
			$('#keynote_add_button').removeAttr('disabled');
		}

		// Hashing
		var hash = CryptoJS.SHA224 (
									$(this).data('admin_code') + 
									$(this).data('hash_code') +
									$(this).val()
									).toString(CryptoJS.enc.Hex).substr(10,6);

		$('#edit_personnal_code').text( ( ($(this).val() != '' && valid === true) ? '/'+hash : '/***' ) );

		if (valid)
		{
			new_personnal_url = $(this).data('base_url') + $(this).val() + '/' + hash
		}

	});

	$('#keynote_add_button').on('click', function()
	{
		if (typeof new_personnal_url !== 'undefined' && new_personnal_url !== false)
		{
			$('#personnal_keynote').append(new_personnal_url + '\r\n');
		}
	});
});