<?php

namespace IntimateTales;

use IntimateTales\Handlers\ACFHandler;

class Plugin extends Components\Plugin 
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
	public ACFHandler $acfHandler;

	// ----------------------------------------------------

    public function onCreate() 
    {
        $this->loadTextdomain( self::DOMAIN, 'languages' );
        $this->acfHandler = new ACFHandler($this);
		
    }
}

Plugin::instance();

require_once dirname( __FILE__ ) . '/public-functions.php';

$res = get_declared_classes();
$autoloaderClassName = '';
foreach ( $res as $className) {
	if (strpos($className, 'ComposerAutoloaderInit') === 0) {
		$autoloaderClassName = $className; // ComposerAutoloaderInit323a579f2019d15e328dd7fec58d8284 for me
		break;
	}
}

$classLoader = $autoloaderClassName::getLoader();
print_r($classLoader->getClassMap());
foreach ($classLoader->getClassMap() as $path) {
	#echo $path;
}