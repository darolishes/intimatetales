<?php

return [

    'paths' => [
        get_theme_file_path('/resources/views'),
        get_parent_theme_file_path('/resources/views'),
        resource_path('views'),
    ],
    'compiled' => env('VIEW_COMPILED_PATH', storage_path('framework/views')),
    'debug' => false,
    'namespaces' => [
        /*
         | Given the below example, in your views use something like:
         |     @include('MyPlugin::some.view.or.partial.here')
         */
        // 'MyPlugin' => WP_PLUGIN_DIR . '/my-plugin/resources/views',
    ],
    'directives' => [
        // 'foo'  => App\View\FooDirective::class,
    ],
];
