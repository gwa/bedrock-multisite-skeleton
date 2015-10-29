<?php

defined('MULTISITE')                  or define('MULTISITE', (getenv('WP_MULTISITE') !== 'false' ? true : false));
defined('SUBDOMAIN_INSTALL')          or define('SUBDOMAIN_INSTALL', (getenv('WP_MULTISITE_SUBDOMAIN_INSTALL') !== 'false' ? true : false));

defined('DOMAIN_CURRENT_SITE')        or define('DOMAIN_CURRENT_SITE', getenv('WP_MULTISITE_DOMAIN_CURRENT_SITE'));
defined('PATH_CURRENT_SITE')          or define('PATH_CURRENT_SITE', getenv('WP_MULTISITE_PATH_CURRENT_SITE'));

defined('SITE_ID_CURRENT_SITE')       or define('SITE_ID_CURRENT_SITE', 1);
defined('BLOG_ID_CURRENT_SITE')       or define('BLOG_ID_CURRENT_SITE', 1);
