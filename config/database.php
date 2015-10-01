<?php

/**
 * DB settings
 */

/* The name of the database for WordPress */
defined('DB_NAME')     or define('DB_NAME', getenv('DB_NAME'));

/* MySQL database username. */
defined('DB_USER')     or define('DB_USER', getenv('DB_USER'));

/* MySQL database password. */
defined('DB_PASSWORD') or define('DB_PASSWORD', getenv('DB_PASSWORD'));

/* MySQL hostname. */
defined('DB_HOST')     or define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');

/* Database Charset to use in creating database tables. */
defined('DB_CHARSET')  or define('DB_CHARSET', 'utf8');

/* The Database Collate type. Don't change this if in doubt. */
defined('DB_COLLATE')  or define('DB_COLLATE', '');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv('GW_DB_PREFIX') ?: 'wp_';
