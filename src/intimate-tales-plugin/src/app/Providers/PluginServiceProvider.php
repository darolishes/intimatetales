<?php

namespace App\Providers;

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
        $this->register_shortcode();
        $this->register_hooks();
    }

    public function register_shortcode(): void
    {
        add_shortcode('intimate-tales_shortcode', function () {
            return view('shortcodes.plugin');
        });
    }

    public function register_hooks(): void
    {
        register_activation_hook(Config::get('INTIMATE_TALES_FILE'), [$this, 'activationRoutine']);
        register_uninstall_hook(Config::get('INTIMATE_TALES_FILE'), [PluginServiceProvider::class, 'uninstallRoutine']);

        add_action('init', [$this, 'plugin_initiated']);
    }

    public function plugin_initiated(): void
    {
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
}
