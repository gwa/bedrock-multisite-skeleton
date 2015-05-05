<?php

/**
 * The bootstrap used by PHPUnit and Build
 */
(PHP_SAPI === 'cli') || die('Access Denied');

define('PHPUNIT_DB_PREFIX', 'phpunit_');

global $wp_rewrite, $wpdb;

//Required for code coverage to run.
//define( 'WP_MAX_MEMORY_LIMIT', '1024M' );
define('WP_MEMORY_LIMIT', '100M');

require_once(dirname( __FILE__ ) . '/web/wp/wp-load.php');
require_once(ABSPATH . 'web/wp/wp-admin/includes/admin.php');

wp_set_current_user(1);
