<?php
/*
 * Plugin Name:       Intimate Tales
 * Plugin URI:        https://intimate-tales.com/
 * Description:       ...
 * Version:           1.0.0
 * Author:            Intimate Tales Team
 * Author URI:        https://intimate-tales.com/
 * License:           
 * License URI:       
 * Text Domain:       intimatetales
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
    die;
}

use IntimateTales\Config;
use IntimateTales\Helpers\Activator;
use IntimateTales\Helpers\Deactivator;
use IntimateTales\Core\MainController;
use IntimateTales\Controllers\Loader;

class IntimateTalesPlugin
{
    const PLUGIN_VERSION = '1.0.0';

    private $mainController;

    public function __construct(MainController $mainController)
    {
        $this->mainController = $mainController;
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), [$this, 'it_settings_link']);
    }

    public function it_settings_link($links)
    {
        $url = get_admin_url() . 'admin.php';
        $settings_link = '<a href="' . $url . '">' . __('Settings', 'intimatetales') . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }

    public function activate()
    {
        Activator::activate();
    }

    public function deactivate()
    {
        Deactivator::deactivate();
    }

    public function run()
    {
        $this->mainController->run();
    }
}

#require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

$intimateTalesPlugin = new IntimateTalesPlugin(new MainController(new Config(), new Loader()));
register_activation_hook(__FILE__, [$intimateTalesPlugin, 'activate']);
register_deactivation_hook(__FILE__, [$intimateTalesPlugin, 'deactivate']);
$intimateTalesPlugin->run();
