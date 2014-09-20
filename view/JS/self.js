$(document).ready(function()
{
	// Gestion de la génération d'adresses personnelles
	$( "#edit_personnal_identifiant" ).on('ready change keyup click hover', null, function() {
		
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
									).toString(CryptoJS.enc.Hex).substr(10,8).toUpperCase();

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

	// Vérification des input de vote
	$( ".vote-parser" ).on('ready change keyup click hover', null, function() {

		// Is empty ?
		if ($(this).val() == "" || $(this).val() == null)
		{
			authorize_edit(true, $(this));
			return ;
		}

		// Is Json ?
		if ( isJson($(this).val()) )
		{
			authorize_edit(true, $(this));
			return ;
		}

		// OK, on test le parsing
		var input = $(this).val().replace(/(\r\n|\n|\r)/g,';');
		var input = explode(';', input);

		input.forEach (prepare_parse , input);

		var regexVote = new RegExp(
		"^(:?[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ, ]+[|]{2} *)?(:?[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ ]+)(:?( *[>=]{1} *)(:?[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿAAAÃÄÅÇEEEËIIIÏÐOOOÕÖUUUÜÝŸ ]+ *))*(:?[*] *[0-9]+ *)?$"
		);
		var is_correct = true ;
		input.forEach (function (element,index) {
			if (!regexVote.test(element))
				{is_correct = false ;}
		});

		if (is_correct)
			{
				authorize_edit(true, $(this));
				return ;
			}
		else
			{
				authorize_edit(false, $(this));
				return ;
			}


		// Final
		authorize_edit(true, $(this));
	});

		function prepare_parse (element, index) {

			// Delete comments
			var is_comment = strpos(this[index], '#') ;
			if (is_comment !== false)
			{
				this[index] = substr(this[index], 0, is_comment) ;
			}

			// Trim
			this[index] = trim(this[index]);
		}


		function isJson (input)
		{
			var isJson = true ;
			try
			{
				var jsonObject = jQuery.parseJSON(input);
			}
			catch(e)
			{
				isJson = false ;
			}

			return isJson ;
		}

		function authorize_edit (valid, boite)
		{
			var button = $('form button[type="submit"]') ;

			if (!valid) { 
				$(boite).css('box-shadow', '0 0 2px 1px red');
				$(button).attr('disabled', 'true');
			}
			else { 
				$(boite).css('box-shadow', 'none');
				$(button).removeAttr('disabled');
			}
		}
});