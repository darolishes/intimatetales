<?php



class Setup
{

    public function init()
    {
        $this->register();
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
}
