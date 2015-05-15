<?php

/* Set the default WordPress theme. */
if (is_dir(getenv(CONTENT_DIR.'/themes/'.WP_THEME))) {
    define('WP_DEFAULT_THEME', getenv('WP_THEME'));
}
