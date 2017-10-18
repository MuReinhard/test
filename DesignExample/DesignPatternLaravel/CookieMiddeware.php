<?php
namespace DesignPatternLaravel\Middeware;
use Closure;

/**
 * @class CookieMiddware
 * @author ShiO
 */
class CookieMiddeware implements IMiddeware {
    /**
     * @author ShiO
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public static function handle($request, Closure $next) {
        echo '我是cookie的中间件' . '<br />';
        $next($request);
        echo '我是cookie的中间件后置' . '<br />';
    }
}