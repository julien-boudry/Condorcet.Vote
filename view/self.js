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
									).toString(CryptoJS.enc.Hex).substr(10,6).toUpperCase();

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
	$( ".vote-parser" ).on('change keyup', null, function() {

		// Is empty ?
		if ($(this).val() == "" || $(this).val() == null)
		{
			authorize_votes(false);
			return ;
		}

		// Is Json ?
		if ( isJson($(this).val()) )
		{
			authorize_votes(true);
			return ;
		}

		// OK, on test le parsing
		var input = $(this).val().replace(/(\r\n|\n|\r)/g,';');
		var input = explode(';', input);

		input.forEach (prepare_parse , input);
		console.log(input);

		var regexVote = new RegExp(
		"^(:?[a-zA-Z0-9, ]+[|]{2} *)?(:?[a-zA-Z0-9]+)(:?( *[>=]{1} *)(:?[a-zA-Z0-9]+ *))*([*] *[0-9]+ *)?$"
		);
		var is_correct = true ;
		input.forEach (function (element,index) {
			if (!regexVote.test(element))
				{is_correct = false ;}
		});

		if (is_correct)
			{
				authorize_votes(true);
				return ;
			}
		else
			{
				authorize_votes(false);
				return ;
			}


		// Final
		authorize_votes(true);
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

		function authorize_votes (valid)
		{
			if (!valid) { 
				$(this).addClass('red-background');
				$('#edit_vote').attr('disabled', 'true');
			}
			else { 
				$(this).removeClass('red-background');
				$('#edit_vote').removeAttr('disabled');
			}

			console.log('change : ' + valid)
		}
});