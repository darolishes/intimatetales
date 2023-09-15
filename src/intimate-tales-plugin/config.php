<?php
/**
 * IntimateTales Plugin Configuration
 */

// Prevent direct access to the file
defined('ABSPATH') or die('Direct script access denied.');

// Plugin Version
define('INTIMATE_TALES_VERSION', '1.0.0');

// Plugin Path
define('INTIMATE_TALES_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Plugin URL
define('INTIMATE_TALES_PLUGIN_URL', plugin_dir_url(__FILE__));

// Plugin Base Name
define('INTIMATE_TALES_PLUGIN_BASENAME', plugin_basename(__FILE__));

// ACF JSON Save Point - for field configuration
define('INTIMATE_TALES_ACF_PATH', INTIMATE_TALES_PLUGIN_PATH . 'acf-json/');

// Enqueue Scripts and Styles Prefix
define('INTIMATE_TALES_ENQUEUE_PREFIX', 'intimate_tales_');

// Textdomain for Internationalization
define('INTIMATE_TALES_TEXTDOMAIN', 'intimate-tales');

// Story Post Type
define('INTIMATE_TALES_STORY_POST_TYPE', 'story');

// Nonces for various actions
define('INTIMATE_AUTHENTICATE_NONCE', 'intimate_authenticate_nonce');
define('INTIMATE_PAIRING_REQUEST_NONCE', 'intimate_pairing_request_nonce');
define('INTIMATE_STORY_ACTION_NONCE', 'intimate_story_action_nonce');

// Hook Prefixes
define('INTIMATE_HOOK_PREFIX', 'intimate_');

// Transients for caching
define('INTIMATE_CACHED_STORY_RESULTS', 'intimate_cached_story_results');
define('INTIMATE_CACHED_USER_DATA', 'intimate_cached_user_data');