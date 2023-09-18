<?php

namespace IntimateTales;

class Constants
{
    const VERSION                       = '1.0.0';
    const ENQUEUE_PREFIX                = 'it_enqueue_';
    const TEXTDOMAIN                    = 'intimate-tales';
    const LANGUAGE_PATH                 = '/languages/';
    const STORY_POST_TYPE               = 'story';
    const HOOK_PREFIX                   = 'it_hook_';
    const CACHED_STORY_RESULTS          = 'it_cached_story_results';
    const CACHED_USER_DATA              = 'it_cached_user_data';
    const AUTHENTICATE_NONCE            = 'it_authenticate_nonce';
    const PAIRING_REQUEST_NONCE         = 'it_pairing_request_nonce';
    const STORY_ACTION_NONCE            = 'it_story_action_nonce';
    const SETTINGS_PAGE                 = 'it-settings';
    const SETTINGS_SECTION_GENERAL      = 'it-settings-general';
    const SETTINGS_SECTION_INTEGRATIONS = 'it-settings-integrations';
    const ENDPOINT_SEARCH               = 'search';
    const ENDPOINT_USER_STORIES         = 'user-stories';

    public static $PLUGIN_PATH;
    public static $PLUGIN_URL;
    public static $PLUGIN_BASENAME;
    public static $ACF;
    public static $VIEWS;

    public function __construct()
    {
        self::$PLUGIN_PATH = plugin_dir_path(__DIR__ . '/../intimate-tales.php');
        self::$PLUGIN_URL = plugin_dir_url(__DIR__ . '/../intimate-tales.php');
        self::$PLUGIN_BASENAME = plugin_basename(__DIR__ . '/../intimate-tales.php');
        self::$ACF = self::$PLUGIN_PATH . 'resources/acf-json/';
        self::$VIEWS = self::$PLUGIN_PATH . 'resources/views/';
    }

    public static function get_plugin_path()
    {
        return self::$PLUGIN_PATH;
    }

    public static function get_plugin_url()
    {
        return self::$PLUGIN_URL;
    }

    public static function get_plugin_basename()
    {
        return self::$PLUGIN_BASENAME;
    }

    public static function get_acf_path()
    {
        return self::$ACF;
    }

    public static function get_views_path()
    {
        return self::$VIEWS;
    }
}