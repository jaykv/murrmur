$(document).ready(function() {
	$('#count').html('150');

	$('#user_post').keydown(function() {
		var text_length = $('#user_post').val().length;
		var text_remaining = 150 - text_length;

		$('#count').html(text_remaining);
	});
});