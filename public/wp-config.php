<?php
/**
 * Do not edit this file. Edit the config files found in the config/ dir instead.
 * This file is required in the root directory so WordPress can find it.
 * WP is hardcoded to look in its own directory or one directory up for wp-config.php.
 */
require_once(dirname(__DIR__) . '/vendor/autoload.php');

require_once(dirname(__DIR__) . '/config/application.php');
require_once(ABSPATH . 'wp-settings.php');

/**
 * Whoops Wordpress ErrorHandler
 */
if (class_exists('Whoops\Run')) {
    (new Gwa\Wordpress\ErrorHandler\ErrorHandler())->run();
}

if (getenv('WP_MULTISITE') !== 'false' && defined('WP_INSTALL_PATH') && class_exists('Gwa\Wordpress\MultisiteDirectoryResolver')) {
    (new Gwa\Wordpress\MultisiteDirectoryResolver(WP_INSTALL_PATH))->init();
}

if (getenv('WP_AUTO_UPDATE') === 'false') {
    (new Gwa\Wordpress\DisableAutoUpdate\AutoUpdateHandler())->init();
}
