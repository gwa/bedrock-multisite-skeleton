<?php
/**
* Cookie settings
*
* Resolving The WordPress Multisite Redirect Loop
*
* @link https://tommcfarlin.com/resolving-the-wordpress-multisite-redirect-loop/
*/
if (filter_var(getenv('WP_MULTISITE_SUBDOMAIN_INSTALL'), FILTER_VALIDATE_BOOLEAN)) {
    define('COOKIE_DOMAIN', $domain);
    define('ADMIN_COOKIE_PATH', '/');
}
