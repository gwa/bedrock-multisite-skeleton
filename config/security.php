<?php
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 */
defined('AUTH_KEY')         or define('AUTH_KEY', getenv('AUTH_KEY'));
defined('SECURE_AUTH_KEY')  or define('SECURE_AUTH_KEY', getenv('SECURE_AUTH_KEY'));
defined('LOGGED_IN_KEY')    or define('LOGGED_IN_KEY', getenv('LOGGED_IN_KEY'));
defined('NONCE_KEY')        or define('NONCE_KEY', getenv('NONCE_KEY'));
defined('AUTH_SALT')        or define('AUTH_SALT', getenv('AUTH_SALT'));
defined('SECURE_AUTH_SALT') or define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
defined('LOGGED_IN_SALT')   or define('LOGGED_IN_SALT', getenv('LOGGED_IN_SALT'));
defined('NONCE_SALT')       or define('NONCE_SALT', getenv('NONCE_SALT'));
