<?php
/*
 * Plugin Name:       Intimate Tales
 * Plugin URI:        https://intimate-tales.com/
 * Description:       ...
 * Version:           1.0.0
 * Author:            Intimate Tales Team
 * Author URI:        https://intimate-tales.com/
 * License:           
 * License URI:       
 * Text Domain:       intimate-tales
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
    die;
}

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use Roots\Acorn\Bootloader;

$basePath = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'src';
$intimateTales = new \Roots\Acorn\Application($basePath);
$intimateTales->usePaths([
    'app' => $basePath . '/app',
    'config' => $basePath . '/config',
    'database' => $basePath . '/database',
    'lang' => $basePath . '/lang',
    'public' => $basePath . '/public',
    'resources' => $basePath . '/resources',
    'storage' => $basePath . '/storage',
    'bootstrap' => $basePath . '/bootstrap',
]);


$intimateTales->boot();