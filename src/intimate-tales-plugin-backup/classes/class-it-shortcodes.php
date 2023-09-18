<?php

/**
 * IT_Shortcodes
 *
 * Handles the creation and rendering of plugin shortcodes.
 *
 * @class    IT_Shortcodes
 * @version  1.0.0
 * @package  IntimateTales/Classes
 */

class IT_Shortcodes
{

    // Reference to the template loader instance.
    private $template_loader;

    public function __construct()
    {
        // Create an instance of the template loader to be used for rendering shortcodes.
        $this->template_loader = new IT_Template_Loader();

        // Registering shortcode callbacks
        add_shortcode('it_login_form', [$this, 'render_login_form']);
        add_shortcode('it_signup_form', [$this, 'render_signup_form']);
        add_shortcode('it_pw_reset_form', [$this, 'render_pw_reset_form']);
    }

    /**
     * Renders the login form using the shortcode.
     *
     * @param array $args Arguments for rendering the login form. Expects 'nonce' and 'action_url'.
     * @return string Rendered output of the login form.
     */
    public function render_login_form($args = [])
    {
        ob_start(); // Start output buffering to capture the rendered template.

        // Defaults for args
        $args = wp_parse_args($args, [
            'nonce' => '',
            'action_url' => ''
        ]);

        // Load the login form template.
        $this->template_loader->load_template('login-form', $args, 'auth');

        return ob_get_clean(); // Return the rendered template and clear the output buffer.
    }

    /**
     * Renders the signup form using the shortcode.
     *
     * @param array $args Arguments for rendering the signup form. Expects 'nonce' and 'action_url'.
     * @return string Rendered output of the signup form.
     */
    public function render_signup_form($args = [])
    {
        ob_start(); // Start output buffering to capture the rendered template.

        // Defaults for args
        $args = wp_parse_args($args, [
            'nonce' => '',
            'action_url' => ''
        ]);

        // Load the signup form template.
        $this->template_loader->load_template('signup-form', $args, 'auth');

        return ob_get_clean(); // Return the rendered template and clear the output buffer.
    }

    /**
     * Renders the password reset form using the shortcode.
     *
     * @param array $args Arguments for rendering the password reset form. Expects 'nonce' and 'action_url'.
     * @return string Rendered output of the password reset form.
     */
    public function render_pw_reset_form($args = [])
    {
        ob_start(); // Start output buffering to capture the rendered template.

        // Defaults for args
        $args = wp_parse_args($args, [
            'nonce' => '',
            'action_url' => ''
        ]);

        // Load the password reset form template.
        $this->template_loader->load_template('password-reset-form', $args, 'auth');

        return ob_get_clean(); // Return the rendered template and clear the output buffer.
    }
}

// Creating an instance of the IT_Shortcodes to initialize the shortcodes.
new IT_Shortcodes();
