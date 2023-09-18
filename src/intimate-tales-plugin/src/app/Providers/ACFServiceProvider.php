<?php

namespace IntimateTales\App\Providers;

use IntimateTales\App\Handlers\ACFHandler;
use Illuminate\Support\ServiceProvider;
use Roots\WPConfig\Config;

use function Roots\bundle;

class ACFServiceProvider extends ServiceProvider
{
    public function register()
    {
        bundle('app')->bind('acfhandler', function () {
            return new ACFHandler(/* Hier können Sie den Pfad oder andere Abhängigkeiten injizieren */);
        });
    }

    public function boot()
    {
        // Hier können Sie alle notwendigen Aktionen und Filter für ACF hinzufügen.
        // Zum Beispiel:
        add_filter('acf/settings/load_json', [$this->app->make('acfhandler'), 'load_json']);
        // ... und so weiter für andere Aktionen und Filter.
    }
}
