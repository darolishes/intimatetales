<?php

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

require_once INTIMATE_TALES_PLUGIN_PATH . 'config.php';

class IntimateTales_Main_Class {

    /**
     * Locate and load a template.
     *
     * @param string $template_name The name of the template to load.
     * @return string Output of the template file.
     */
    public function load_template($template_name) {
        // Check for a custom template in the theme
        $template = locate_template("intimate-tales/{$template_name}.php");
        
        // Fall back to the plugin's template directory if no custom template is found
        if (!$template) {
            $template = INTIMATE_TALES_PLUGIN_PATH . "templates/{$template_name}.php";
        }

        ob_start();
        include $template;
        return ob_get_clean();
    }
}
