npm install

php -r 'include "wp-load.php"; activate_plugin("intimate-tales/intimate-tales.php");'

php -r 'include "wp-load.php"; IntimateTalesPlugin::init_plugin();'

php -r 'include "wp-load.php"; IntimateTalesPlugin::enqueue_scripts();'

php -r 'include "wp-load.php"; IntimateTalesPlugin::register_shortcodes();'

php -r 'include "wp-load.php"; echo IntimateTalesPlugin::render_shortcode("example_shortcode");'

php -r 'include "wp-load.php"; IntimateTalesPlugin::process_form_submission();'
