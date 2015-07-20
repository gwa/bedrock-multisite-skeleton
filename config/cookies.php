<?php

/**
* Cookie settings
*
* Resolving The WordPress Multisite Redirect Loop
*
* @link https://tommcfarlin.com/resolving-the-wordpress-multisite-redirect-loop/
*/
if (getenv('WP_MULTISITE_SUBDOMAIN_INSTALL') !== 'false') {
    $domain = $_SERVER[ 'HTTP_HOST' ];

    define('COOKIE_DOMAIN', $domain);
    define('ADMIN_COOKIE_PATH', '/');
}
