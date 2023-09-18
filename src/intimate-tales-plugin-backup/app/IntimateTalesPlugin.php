<?php

namespace IntimateTales;

use IntimateTales\Config\Config;
use IntimateTales\Helpers\Activator;
use IntimateTales\Helpers\Deactivator;
use IntimateTales\Core\MainController;

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
