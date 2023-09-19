<?php

use Illuminate\Support\Facades\Facade;

use function Roots\env;

return [
    'name' => env('APP_NAME', 'Intimate Tales'),
    'env' => defined('WP_ENV') ? WP_ENV : env('WP_ENV', 'production'),
    'debug' => WP_DEBUG && WP_DEBUG_DISPLAY,
    'url' => env('APP_URL', home_url()),
    'acf_path' => plugin_dir_path(dirname(__FILE__, 2)) . 'resources/acf-json/',
    'timezone' => get_option('timezone_string', 'UTC'),
    'locale' => get_locale(),
    'fallback_locale' => 'de',
    'faker_locale' => 'de_DE',
    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',
    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],
    'providers' => [

        /*
         * Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Database\MigrationServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Foundation\Providers\ComposerServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Routing\RoutingServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Roots\Acorn\Assets\AssetsServiceProvider::class,
        Roots\Acorn\Filesystem\FilesystemServiceProvider::class,
        Roots\Acorn\Providers\AcornServiceProvider::class,
        Roots\Acorn\Providers\RouteServiceProvider::class,
        Roots\Acorn\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        IntimateTales\App\Providers\PluginServiceProvider::class,
        IntimateTales\App\Providers\ACFServiceProvider::class
    ],

    'aliases' => Facade::defaultAliases()->merge([
        // 'ExampleClass' => App\Example\ExampleClass::class,
    ])->toArray(),

];
