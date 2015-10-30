<?php
// Get path to parent directory
//
$rootDir = dirname(__DIR__);
$domain = $_SERVER['HTTP_HOST'];

// Load settings from .env file, if it exists
//
if (class_exists('Dotenv\Dotenv')) {
    $dotenv = new \Dotenv\Dotenv($rootDir);

    if (file_exists($rootDir . '/.env')) {
        $dotenv->load();
    }

    $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME']);

    if (
        filter_var(getenv('WP_MULTISITE'), FILTER_VALIDATE_BOOLEAN) &&
        getenv('WP_MULTISITE_DOMAIN_CURRENT_SITE') !== ''
    ) {
        $dotenv->required([
            'WP_MULTISITE_PATH_CURRENT_SITE',
            'WP_MULTISITE_SUBDOMAIN_INSTALL',
            'WP_MULTISITE_DOMAIN_CURRENT_SITE'
        ]);
    }
}

// Load environment files, if they exist
//
$envConfig = __DIR__ . '/environments/local.php';
if (file_exists($envConfig)) {
    require_once $envConfig;
}

$env = getenv('GW_ENV') ?: 'production';
$envConfig = __DIR__ . '/environments/' . $env . '.php';
if (file_exists($envConfig)) {
    require_once $envConfig;
}

$envConfig = __DIR__ . '/environments/default.php';
if (file_exists($envConfig)) {
    require_once $envConfig;
}

unset($env);
unset($envConfig);

// Settings files
//
require_once('paths.php');
require_once('database.php');
require_once('security.php');

// Wordpress multisite
//
defined('WP_ALLOW_MULTISITE') or define(
    'WP_ALLOW_MULTISITE',
    filter_var(getenv('WP_MULTISITE'), FILTER_VALIDATE_BOOLEAN)
);

require_once('wordpress.php');

if (defined('WP_ALLOW_MULTISITE') && getenv('WP_MULTISITE_DOMAIN_CURRENT_SITE') !== '') {
    require_once('cookies.php');
    require_once('multisite.php');
}

unset($rootDir);
unset($domain);

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', WP_HOME . '/' . getenv('GW_WP_DIR') . '/');
}
