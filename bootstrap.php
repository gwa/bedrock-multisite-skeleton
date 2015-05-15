<?php

require_once(dirname(__DIR__) . '/vendor/autoload.php');

/**
 * The bootstrap used by PHPUnit and Build
 */
(PHP_SAPI === 'cli') || die('Access Denied');

define('PHPUNIT_DB_PREFIX', 'phpunit_');

//Required for code coverage to run.
//define( 'WP_MAX_MEMORY_LIMIT', '1024M' );
define('WP_MEMORY_LIMIT', '100M');
