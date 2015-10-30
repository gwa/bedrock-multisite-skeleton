<?php

defined('EMPTY_TRASH_DAYS')           or define('EMPTY_TRASH_DAYS', getenv('EMPTY_TRASH_DAYS'));
defined('WP_POST_REVISIONS')          or define('WP_POST_REVISIONS', getenv('WP_POST_REVISIONS'));
defined('AUTOMATIC_UPDATER_DISABLED') or define('AUTOMATIC_UPDATER_DISABLED', true);
defined('DISABLE_WP_CRON')            or define('DISABLE_WP_CRON', getenv('DISABLE_WP_CRON') ?: false);
defined('DISALLOW_FILE_EDIT')         or define('DISALLOW_FILE_EDIT', true);

// set default theme
if (getenv('GW_THEME') && is_dir(getenv('CONTENT_DIR') . '/themes/' . getenv('GW_THEME'))) {
    define('WP_DEFAULT_THEME', getenv('GW_THEME'));
}
