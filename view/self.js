$(document).ready(function()
{
	$( "#edit_personnal_identifiant" ).on('change keyup click', null, function() {
		
		var hash = CryptoJS.SHA224("Message" + $(this).val()).toString(CryptoJS.enc.Hex).substr(10,6);

		$('#edit_personnal_code').text( ( ($(this).val() != '') ? hash : '***' ) );

	});
});