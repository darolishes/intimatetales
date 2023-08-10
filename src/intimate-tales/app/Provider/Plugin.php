<?php

namespace IT\Provider;

use IT\Models\PostTypes\PostType;
use IT\Services\InviteService;

class Plugin
{

    private PostType $postType;
    //private Post $post;
    //private User $user;
    //private EmailNotifier $notifier;

    public function __construct()
    {
        $this->register();
        //$this->post = new Post();
        //$this->user = new User();
        //$this->notifier = new EmailNotifier();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $postTypesConfig = file_get_contents( INTIMATE_TALES_PLUGIN_DIR . 'config/post-types.json' );
        $postTypesConfig = json_decode( $postTypesConfig, true );

        foreach ( $postTypesConfig as $postTypeName => $postTypeConfig ) {
            $postType = new PostType( $postTypeConfig );
            $postType->registerPostType();
        }
    }

    public function activate()
    {
        //$inviteService = new InviteService();
        //$inviteService->sendInvites();

        $this->postType->registerPostType();
    }

    public function deactivate()
    {
        delete_option( 'intimate_tales_invites' );
    }

    // Static wrappers for activation and deactivation to be used with WordPress hooks
    public static function onActivate()
    {
        $plugin = self::initializePlugin();
        $plugin->activate();
    }

    public static function onDeactivate()
    {
        $plugin = self::initializePlugin();
        $plugin->deactivate();
    }
}

// Register activation/deactivation hooks
register_activation_hook( __FILE__, '\IT\Provider\Plugin::onActivate' );
register_deactivation_hook( __FILE__, '\IT\Provider\Plugin::onDeactivate' );

// Load the Plugin and execute
new \IT\Provider\Plugin();
