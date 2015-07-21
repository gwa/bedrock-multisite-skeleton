<?php

$rootDir    = dirname(__DIR__);
$webrootDir = $rootDir . '/public';

if (class_exists('Dotenv')) {
    /**
     * Use Dotenv to set required environment variables and load .env file in root
     */
    if (file_exists($rootDir . '/.env')) {
        Dotenv::load($rootDir);
    }

    Dotenv::required(['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME', 'WP_SITEURL']);
}

/**
 * Set up our global environment constant and load its config first
 * Default: development
 */
define('WP_ENV', getenv('WP_ENV') ?: 'development');

$envConfig = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($envConfig)) {
    require_once $envConfig;
}

/**
 * URLs
 */
if (getenv('WP_MULTISITE_SUBDOMAIN_INSTALL') !== 'false') {
    define('WP_HOME', '//'.$_SERVER['HTTP_HOST'].'/');
    define('WP_SITEURL', '//'.$_SERVER['HTTP_HOST'].'/wp/');
} else {
    define('WP_HOME', getenv('WP_HOME'));
    define('WP_SITEURL', getenv('WP_SITEURL'));
}

/**
 * Custom Content Directory
 */
define('CONTENT_DIR', '/app');
define('PLUGIN_DIR', $webrootDir.'/app/plugins/');
define('WP_CONTENT_DIR', $webrootDir . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);

/* Set the trash to less days to optimize WordPress. */
define('EMPTY_TRASH_DAYS', getenv('EMPTY_TRASH_DAYS'));

require_once('database.php');

/* Specify the Number of Post Revisions. */
define('WP_POST_REVISIONS', getenv('WP_POST_REVISIONS'));

/**
 * Custom Settings
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISABLE_WP_CRON', true);
define('DISALLOW_FILE_EDIT', true);

require_once('security.php');

/**
 * Wordpress multisite
 */
define('WP_ALLOW_MULTISITE', (getenv('WP_MULTISITE') !== 'false' ? true : false));

if (getenv('WP_MULTISITE') !== 'false' && getenv('WP_MULTISITE_DOMAIN_CURRENT_SITE') !== '') {
    require_once __DIR__ . '/multisite.php';
    require_once('cookies.php');
}

require_once('theme.php');

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', $webrootDir . '/wp/');
}
