<?php
// URLs
$webroot = getenv('GW_WEB_ROOT') ?: 'public';
$wpdir   = getenv('GW_WP_DIR') ?: 'wp';

defined('WP_HOME')    or define('WP_HOME', getenv('WP_HOME'));
defined('WP_SITEURL') or define('WP_SITEURL', WP_HOME . '/' . $wpdir);

// Directories
$content    = getenv('GW_CONTENT_DIR') ?: 'app';
$contentDir = $rootDir . '/' . $webroot . '/' . $content;

// Custom directory paths
defined('WP_CONTENT_DIR') or define('WP_CONTENT_DIR', $contentDir);
defined('WP_PLUGIN_DIR')  or define('WP_PLUGIN_DIR', $contentDir . '/plugins');

defined('WP_CONTENT_URL') or define('WP_CONTENT_URL', WP_HOME . '/' . $content);

unset($wpdir);
unset($content);
unset($contentDir);
