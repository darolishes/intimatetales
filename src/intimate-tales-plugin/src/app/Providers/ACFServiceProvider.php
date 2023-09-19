<?php

namespace IntimateTales\App\Providers;

use Roots\WPConfig\Config;
use IntimateTales\App\Handlers\ACFHandler;
use Illuminate\Support\ServiceProvider;

class ACFServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ACFHandler::class, function ($app) {
            $acf_path = config('app.acf_path');
            return new ACFHandler($app, $acf_path);
        });
    }

    public function boot()
    {
        $acf_handler = $this->app->make(ACFHandler::class);

        add_filter('acf/settings/load_json', [$acf_handler, 'load_json']);
        add_filter('acf/settings/save_json', [$acf_handler, 'save_json']);
        add_filter('acf/json/save_paths', [$acf_handler, 'save_paths']);
        add_filter('acf/json/save_file_name', [$acf_handler, 'save_file_name']);
    }
}