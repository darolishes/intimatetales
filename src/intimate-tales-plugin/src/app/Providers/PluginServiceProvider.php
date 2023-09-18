<?php

namespace IntimateTales\App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Roots\WPConfig\Config;
use Symfony\Component\HttpFoundation\Response;

use function Roots\bundle;
use function Roots\view;

class PluginServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerShortcode();
        $this->registerHooks();
        $this->buildAdminControlPanel();
    }

    public function registerShortcode(): void
    {
        add_shortcode('intimate-tales_shortcode', function () {
            bundle('app')->enqueueCss();

            return view('shortcodes.plugin');
        });
    }

    public function registerHooks(): void
    {
        register_activation_hook(Config::get('INTIMATE_TALES_FILE'), [$this, 'activationRoutine']);
        register_uninstall_hook(Config::get('INTIMATE_TALES_FILE'), [PluginServiceProvider::class, 'uninstallRoutine']);

        add_action('init', [$this, 'pluginInitiated']);
    }

    public function pluginInitiated(): void
    {
        //
    }

    public function activationRoutine(): void
    {
        Artisan::call('migrate', ['--force' => true]);
        Log::debug(Artisan::output());
    }

    public static function uninstallRoutine(): void
    {
        Schema::drop('intimate-tales_migrations');
    }

    public function buildAdminControlPanel(): void
    {
        add_action('admin_menu', function () {
            add_menu_page(
                'Intimate Tales Settings',
                'Intimate Tales',
                'manage_options',
                'intimate-tales',
                [$this, 'renderAdminControlPanel']
            );
        });
    }

    public function renderAdminControlPanel(): Response
    {
        return response()->view('admin.settings')->send();
    }
}
