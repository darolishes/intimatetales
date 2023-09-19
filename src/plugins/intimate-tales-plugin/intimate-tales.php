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

use Roots\Acorn\Application;

// Sicherstellen, dass Acorn geladen ist
if (!class_exists(Application::class)) {
    return;
}

// Erstellen Sie eine Instanz von Acorn
$app = Application::getInstance();

// Service-Provider registrieren
$app->register([
    IntimateTales\Providers\IntimateTalesACFIntegration::class,
]);

// Booten Sie das Framework
$app->boot();