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

    if ((bool) getenv('GW_MULTISITE') && getenv('WP_MULTISITE_DOMAIN_CURRENT_SITE') !== '') {
        $dotenv->required(['WP_INSTALL_PATH', 'WP_MULTISITE_PATH_CURRENT_SITE', 'WP_MULTISITE_SUBDOMAIN_INSTALL', 'WP_MULTISITE_DOMAIN_CURRENT_SITE']);
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
defined('WP_ALLOW_MULTISITE') or define('WP_ALLOW_MULTISITE', (bool) getenv('GW_MULTISITE'));

if ((bool) getenv('GW_MULTISITE') && getenv('WP_MULTISITE_DOMAIN_CURRENT_SITE') !== '') {
    require_once('multisite.php');
    require_once('cookies.php');
}

require_once('settings.php');

unset($rootDir);
unset($domain);
