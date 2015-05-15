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

use Whoops\Exception\Formatter;
use Whoops\Handler\Handler;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Util\Misc;

/**
 * AdminAjaxHandler.
 *
 * @author  GWA
 */
class AdminAjaxHandler extends JsonResponseHandler
{
    /**
     * @return bool
     */
    protected function isAjaxRequest()
    {
        return defined('DOING_AJAX') && DOING_AJAX;
    }

    /**
     * @return int
     */
    public function handle()
    {
        if ($this->onlyForAjaxRequests() && ! $this->isAjaxRequest()) {
            return Handler::DONE;
        }

        $response = [
            'success' => false,
            'data'    => Formatter::formatExceptionAsDataArray($this->getInspector(), $this->addTraceToOutput()),
        ];

        if (Misc::canSendHeaders()) {
            header('Content-Type: application/json; charset='.get_option('blog_charset'));
        }

        $json_options = version_compare(PHP_VERSION, '5.4.0', '>=') ? JSON_PRETTY_PRINT : 0;

        echo json_encode($response, $json_options);

        return Handler::QUIT;
    }
}
