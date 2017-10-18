<?php
namespace DesignPatternLaravel\Croe;

use Closure;
use DesignPatternLaravel\Middeware\IMiddeware;

/**
 * @class Request
 * @author ShiO
 */
class Request implements IMiddeware {
    private $kernel;

    /**
     * @author ShiO
     * Request constructor.
     */
    public function __construct() {
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getRequest() {
        return $this;
    }

    /**
     * @author ShiO
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public static function handle($request, Closure $next) {
        echo 'Requset:在启动所有中间件前，启动request' . '<br />';
        $next($request);
        echo 'Requset:在启动所有中间件后' . '<br />';
    }
}