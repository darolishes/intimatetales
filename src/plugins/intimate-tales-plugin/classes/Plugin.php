<?php

namespace IntimateTales;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

use IntimateTales\Handlers\ACF_Handler;
use IntimateTales\Meta\Meta_Factory;

class IT_Plugin extends Components\Plugin
{
	const DOMAIN                        = 'intimatetales';
	const VERSION                       = '1.0.0';
	const ENQUEUE_PREFIX                = 'it_enqueue_';
	const STORY_POST_TYPE               = 'story';
	const HOOK_PREFIX                   = 'it_hook_';

	// ----------------------------------------------------
	// Settings
	// ----------------------------------------------------
	const SETTINGS                      = 'it-settings';
	const SETTINGS_GENERAL              = 'it-settings-general';
	const SETTINGS_INTEGRATIONS         = 'it-settings-integrations';
	const SETTINGS_DESIGN               = 'it-settings-design';
	const SETTINGS_USER                 = 'it-settings-user';

	// ----------------------------------------------------
	// Endpoints
	// ----------------------------------------------------
	const ENDPOINT_SEARCH               = 'search';
	const ENDPOINT_USER_STORIES         = 'user-stories';
	const ENDPOINT_USER_STORY           = 'user-story';
	const ENDPOINT_STORY_ACTION         = 'story-action';

	// ----------------------------------------------------
	// initialize plugin features
	// ----------------------------------------------------
	public ACF_Handler $acf_handler;
	public Meta_Factory $meta_factory;


	// ----------------------------------------------------

	public function on_create()
	{
		$this->load_textdomain(self::DOMAIN, 'languages');
		$this->acf_handler	= new ACF_Handler($this);
	}
}

Plugin::instance();

require_once dirname(__FILE__) . '/public-functions.php';
