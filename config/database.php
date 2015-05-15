<?php

/**
 * DB settings
 */

/* The name of the database for WordPress */
define('DB_NAME', getenv('DB_NAME'));

/* MySQL database username. */
define('DB_USER', getenv('DB_USER'));

/* MySQL database password. */
define('DB_PASSWORD', getenv('DB_PASSWORD'));

/* MySQL hostname. */
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');

/* Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/* The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


/*
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv('DB_PREFIX') ?: 'wp_';