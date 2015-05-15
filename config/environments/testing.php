<?php

(defined('PHPUNIT_DB_PREFIX')) ? PHPUNIT_DB_PREFIX :'wp_';

define('WP_TESTS_TITLE', 'PHPUnit Test Blog');
define('WP_TESTS_NETWORK_TITLE', 'PHPUnit Test Network');
define('WP_TESTS_SUBDOMAIN_INSTALL', true);

define('WPLANG', '');
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);

/* Cron tries to make an HTTP request to the blog, which always fails, because tests are run in CLI mode only */
define('DISABLE_WP_CRON', true);
define('WP_ALLOW_MULTISITE',  (getenv('WP_MULTISITE') !== 'false' ? true : false));

if (WP_ALLOW_MULTISITE) {
    define('WP_TESTS_BLOGS', 'first,second,third,fourth');
}

if (WP_ALLOW_MULTISITE && !defined('WP_INSTALLING')) {
    define('SUBDOMAIN_INSTALL', WP_TESTS_SUBDOMAIN_INSTALL);
    define('MULTISITE', true);

    define('WP_INSTALL_PATH',     getenv('WP_INSTALL_PATH'));
    define('MULTISITE',           (getenv('WP_MULTISITE') !== 'false' ? true : false));

    define('DOMAIN_CURRENT_SITE', getenv('WP_MULTISITE_DOMAIN_CURRENT_SITE'));
    define('PATH_CURRENT_SITE',   getenv('WP_MULTISITE_PATH_CURRENT_SITE'));

    define('SITE_ID_CURRENT_SITE', 1);
    define('BLOG_ID_CURRENT_SITE', 1);
}

define('WP_PHP_BINARY', 'php');
