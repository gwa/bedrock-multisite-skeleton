<?php
namespace Gwa\Wordpress\ErrorHandler;

/**
 * Wordpress Multisite fixer.
 *
 * @author      Daniel Bannert <bannert@greatwhiteark.com>
 * @copyright   2015 Great White Ark
 *
 * @link        http://www.greatwhiteark.com
 *
 * @license     MIT
 */

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Handler.
 *
 * @author  GWA
 */
class ErrorHandler
{
    protected $tables = [];

    public function __construct()
    {
        $this->tables = [
            '$wp'       => function () {
                global $wp;

                if (!$wp instanceof \WP) {
                    return array();
                }

                $output = get_object_vars($wp);
                unset($output['private_query_vars']);
                unset($output['public_query_vars']);

                return array_filter($output);
            },
            '$wp_query' => function () {
                global $wp_query;

                if (!$wp_query instanceof \WP_Query) {
                    return array();
                }

                $output               = get_object_vars($wp_query);
                $output['query_vars'] = array_filter($output['query_vars']);

                unset($output['posts']);
                unset($output['post']);

                return array_filter($output);
            },
            '$post'     => function () {
                $post = get_post();

                if (!$post instanceof \WP_Post) {
                    return array();
                }

                return get_object_vars($post);
            },
        ];
    }

    protected function handlerPretty()
    {
        $handler = new PrettyPageHandler();
        foreach ($this->tables as $name => $callback) {
            $handler->addDataTableCallback($name, $callback);
        }

        $handler->addResourcePath(dirname(__FILE__).'/Resources');

        return $handler;
    }

    protected function handlerJson()
    {
        $handler = new AdminAjaxHandler();

        $handler->addTraceToOutput(true);
        $handler->onlyForAjaxRequests(true);

        return $handler;
    }

    protected function runWhops()
    {
        $run = new Run();

        $run->pushHandler($this->handlerPretty());
        $run->pushHandler($this->handlerJson());

        return $run;
    }

    /**
     * @return bool
     */
    public function is_debug()
    {
        return defined('WP_DEBUG') && WP_DEBUG;
    }

    /**
     * @return bool
     */
    public function is_debug_display()
    {
        return defined('WP_DEBUG_DISPLAY') && false !== WP_DEBUG_DISPLAY;
    }

    public function run()
    {
        if (!$this->is_debug() || !$this->is_debug_display()) {
            return;
        }

        $run = $this->runWhops();
        $run->register();

        ob_start(); // or we are going to be spitting out WP markup before whoops
    }
}
