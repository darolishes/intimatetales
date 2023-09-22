jQuery(document).ready(function ($) {
	$('#load-next-story').click(function () {
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'load_next_story_action',
			},
			success: function (response) {
				// Setze die Antwort (also die Geschichte) in ein HTML-Element ein
				$('#story-container').html(response);
			},
		});
	});

	/**
	 *
	 */
	$('.decision-button').click(function () {
		var decision = $(this).data('decision'); // Angenommen, Sie haben ein data-decision-Attribut

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'save_user_decision_action',
				decision: decision,
			},
			success: function (response) {
				// Verarbeiten Sie die Antwort, z. B. Anzeigen einer Bestätigung
			},
		});
	});
});
