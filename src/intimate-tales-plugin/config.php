<?php

/**
 * IntimateTales Plugin Configuration
 *
 * This file contains the configuration settings for the IntimateTales Plugin.
 * It includes shared dependencies and initializes key components.
 *
 * @package IntimateTalesPlugin
 * @subpackage Config
 */

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    die('Direct script access denied.');
}

// Plugin Information
// ------------------

// Plugin Version
// This constant stores the current version of the plugin.
define('IT_VERSION', '1.0.0');

// Plugin Path
// This constant stores the absolute path to the plugin directory.
define('IT_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Plugin URL
// This constant stores the URL of the plugin directory.
define('IT_PLUGIN_URL', plugin_dir_url(__FILE__));

// Plugin Base Name
// This constant stores the base name of the plugin file (relative to the plugins directory).
define('IT_PLUGIN_BASENAME', plugin_basename(__FILE__));

// ACF Configuration
// -----------------

// ACF JSON Save Point - for field configuration
// This constant stores the path to the directory where ACF field configuration is saved.
define('IT_ACF_PATH', IT_PLUGIN_PATH . 'acf-json/');

// Enqueue Scripts and Styles Prefix
// This constant stores the prefix used when enqueuing scripts and styles for the plugin.
define('IT_ENQUEUE_PREFIX', 'intimate_tales_');

// Internationalization
// --------------------

// Textdomain for Internationalization
// This constant stores the text domain used for internationalization.
define('IT_TEXTDOMAIN', 'intimate-tales');

// Post Types
// ----------

// Story Post Type
// This constant stores the name of the custom post type for stories.
define('IT_STORY_POST_TYPE', 'story');

// Hooks and Actions
// -----------------

// Hook Prefixes
// This constant stores the prefix used for all hooks and actions related to the plugin.
define('IT_HOOK_PREFIX', 'intimate_');

// Transients for caching
// These constants store the names of the transients used for caching.
define('IT_CACHED_STORY_RESULTS', IT_HOOK_PREFIX . 'cached_story_results');
define('IT_CACHED_USER_DATA', IT_HOOK_PREFIX . 'cached_user_data');

// Nonces for various actions
// These constants store the names of the nonces used for various actions.
define('IT_AUTHENTICATE_NONCE', IT_HOOK_PREFIX . 'authenticate_nonce');
define('IT_PAIRING_REQUEST_NONCE', IT_HOOK_PREFIX . 'pairing_request_nonce');
define('IT_STORY_ACTION_NONCE', IT_HOOK_PREFIX . 'story_action_nonce');

// Include shared dependencies.
// Error handling is added to handle any errors that may occur when the settings are being used.
try {
    require_once 'includes/class-main.php';
    # require_once 'includes/class-authentication.php';
    # require_once 'includes/class-dashboard.php';
    # require_once 'includes/class-roleplay-interface.php';
    # require_once 'includes/class-pairing-system.php';
    # require_once 'includes/class-ai-story-generator.php';
    # require_once 'includes/class-gamification.php';
    # require_once 'includes/class-rewards.php';
    # require_once 'includes/class-onboarding.php';
    # require_once 'includes/class-category-list.php';
    # require_once 'includes/class-notification.php';
} catch (Exception $e) {
    error_log("Error loading intimate-tales dependencies: " . $e->getMessage());
    exit;
}
