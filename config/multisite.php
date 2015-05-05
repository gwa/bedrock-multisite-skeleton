<?php
/*Multisite config*/

Dotenv::required(['WP_INSTALL_PATH', 'WP_MULTISITE_PATH_CURRENT_SITE', 'WP_MULTISITE_SUBDOMAIN_INSTALL', 'WP_MULTISITE_DOMAIN_CURRENT_SITE']);

define('WP_INSTALL_PATH',     getenv('WP_INSTALL_PATH'));

define('MULTISITE',           (getenv('WP_MULTISITE') !== 'false' ? true : false));
define('SUBDOMAIN_INSTALL',   (getenv('WP_MULTISITE_SUBDOMAIN_INSTALL') !== 'false' ? true : false));

define('DOMAIN_CURRENT_SITE', getenv('WP_MULTISITE_DOMAIN_CURRENT_SITE'));
define('PATH_CURRENT_SITE',   getenv('WP_MULTISITE_PATH_CURRENT_SITE'));

define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
