<?php

/* Set the default WordPress theme. */
if (is_dir(getenv(CONTENT_DIR.'/themes/'.getenv('WP_THEME')))) {
    define('WP_DEFAULT_THEME', getenv('WP_THEME'));
}
