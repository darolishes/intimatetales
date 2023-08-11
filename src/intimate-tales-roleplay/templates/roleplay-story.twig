<div class="rollenspiel-story">
    <!-- Story content will be rendered here -->
    <div id="story-content"></div>

    <!-- User decisions can be made here -->
    <div id="story-decisions">
        <!-- Placeholder for decision buttons, these can be replaced with actual decision options -->
        <button data-decision="option1">Entscheidung 1</button>
        <button data-decision="option2">Entscheidung 2</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load user decisions and update the story content
        jQuery.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'load_decision'
            },
            success: function(response) {
                if (response.success) {
                    document.getElementById('story-content').innerHTML = response.data;
                }
            }
        });

        // Listen for decision buttons click
        jQuery('#story-decisions button').on('click', function() {
            var decision = jQuery(this).data('decision');

            // Save user decision using AJAX
            jQuery.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'save_decision',
                    decision: decision
                },
                success: function(response) {
                    if (response.success) {
                        // Update the story content based on the decision
                        document.getElementById('story-content').innerHTML = response.data;
                    }
                }
            });
        });
    });
</script>