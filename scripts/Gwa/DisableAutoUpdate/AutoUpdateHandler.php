<?php
namespace Gwa\Wordpress\DisableAutoUpdate;

/**
 * A modern WordPress stack.
 *
 * @author      Daniel Bannert <bannert@greatwhiteark.com>
 * @copyright   2015 Great White Ark
 *
 * @link        http://www.greatwhiteark.com
 *
 * @license     MIT
 */

/**
 * AutoUpdateHandler.
 *
 * @author  GWA
 */
class AutoUpdateHandler
{
    /**
     * Disable All Automatic Updates
     * 3.7+
     *
     * @author  sLa NGjI's @ slangji.wordpress.com
     */
    protected function disableWpAutoUpdate()
    {
        add_filter('auto_update_translation', '__return_false');
        add_filter('automatic_updater_disabled', '__return_true');
        add_filter('allow_minor_auto_core_updates', '__return_false');
        add_filter('allow_major_auto_core_updates', '__return_false');
        add_filter('allow_dev_auto_core_updates', '__return_false');
        add_filter('auto_update_core', '__return_false');
        add_filter('wp_auto_update_core', '__return_false');
        //add_filter('auto_core_update_send_email', '__return_false');
        //add_filter('send_core_update_notification_email', '__return_false');
        add_filter('auto_update_plugin', '__return_false');
        add_filter('auto_update_theme', '__return_false');
        add_filter('automatic_updates_send_debug_email', '__return_false');
        add_filter('automatic_updates_is_vcs_checkout', '__return_true');

        //add_filter('automatic_updates_send_debug_email ', '__return_false', 1);

        if (!defined('AUTOMATIC_UPDATER_DISABLED')) {
            define('AUTOMATIC_UPDATER_DISABLED', true);
        }

        if (!defined('WP_AUTO_UPDATE_CORE')) {
            define('WP_AUTO_UPDATE_CORE', false);
        }
    }

    /**
     * Check the outgoing request
     */
    public function blockWpRequest($pre, $args, $url)
    {
        if (empty($url)) {
            return $pre;
        }

        /* Invalid host */
        if (!$host = parse_url($url, PHP_URL_HOST)) {
            return $pre;
        }

        $urlData = parse_url($url);

        /* block request */
        $path =  (false !== stripos($urlData['path'], 'update-check') || false !== stripos($urlData['path'], 'browse-happy'));

        if (false !== stripos($host, 'api.wordpress.org') && $path) {
            return true;
        }

        return $pre;
    }

    /**
     * Hide all noctices in wp-admin
     */
    protected function hideAdminNag()
    {
        if (!function_exists("remove_action")) {
            return;
        }

        /**
         * Hide maintenance and update nag
         */
        //remove_action('admin_notices', 'update_nag', 3);
        //remove_action('network_admin_notices', 'update_nag', 3);
        //remove_action('admin_notices', 'maintenance_nag');
        //remove_action('network_admin_notices', 'maintenance_nag');

        remove_action('wp_maybe_auto_update', 'wp_maybe_auto_update');
        remove_action('admin_init', 'wp_maybe_auto_update');
        remove_action('admin_init', 'wp_auto_update_core');

        wp_clear_scheduled_hook('wp_maybe_auto_update');
    }

    /**
     * init
     */
    public function init()
    {
        $this->disableWpAutoUpdate();

        add_filter('pre_http_request', [$this, 'blockWpRequest'], 10, 3);

        $this->hideAdminNag();
    }
}
