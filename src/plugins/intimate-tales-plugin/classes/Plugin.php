<?php
namespace IntimateTales;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

use IntimateTales\Meta\Meta_Factory;
use IntimateTales\Components\Templates;
use IntimateTales\Services\ACFService;
use IntimateTales\Services\ServiceContainer;
use IntimateTales\Authentication\UserManager;
use IntimateTales\Authentication\EmailManager;

/**
 * Class Plugin
 *
 * @package IntimateTales
 */
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

    private ServiceContainer $service_container;
	
	public function on_create()
	{
		$this->service_container = new ServiceContainer();
		$this->load_textdomain(self::DOMAIN, 'languages');

		// Initialize templates
		$this->service_container->add_service('templates', new Templates($this));
		
		// Initialize services
        $this->service_container->add_service('acf_service', new ACFService($this));
        $this->service_container->add_service('meta_factory', new Meta_Factory());

		// Initialize UserManager with EmailManager
		$email_manager = new EmailManager();
		$user_manager = new UserManager($email_manager);
		$this->service_container->add_service('user_manager', $user_manager);

}

    /**
     * Get a service from the container.
     *
     * @param string $service_name
     * @return mixed|null
     */
    public function get_service(string $service_name)
    {
        return $this->service_container->get($service_name);
    }
}

Plugin::instance();

require_once dirname(__FILE__) . '/public-functions.php';
