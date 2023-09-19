<?php

namespace IntimateTales\Config;

class PluginConfig
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
	const ENDPOINT_USER_STORY           = 'user-story';
	const ENDPOINT_STORY_ACTION         = 'story-action';

	private static $initialized = false;
	public static $PLUGIN_PATH;
	public static $PLUGIN_URL;
	public static $PLUGIN_BASENAME;
	public static $ACF;
	public static $VIEWS;

	private static function initialize()
	{
		if (self::$initialized) {
			return;
		}

		self::$PLUGIN_PATH = INTIMATE_TALES_DIR;
		self::$PLUGIN_URL = INTIMATE_TALES_URL;
		self::$PLUGIN_BASENAME = INTIMATE_TALES_BASENAME;

		self::$ACF = self::$PLUGIN_PATH . 'resources/acf-json/';
		self::$VIEWS = self::$PLUGIN_PATH . 'resources/views/';

		self::$initialized = true;
	}

	public static function get($key, $default = null)
	{
		if (!self::$initialized) {
			self::initialize();
		}

		// Überprüfen Sie, ob die angeforderte Eigenschaft existiert und zurückgeben.
		if (property_exists(__CLASS__, $key)) {
			return self::${$key};
		}

		return $default;
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
