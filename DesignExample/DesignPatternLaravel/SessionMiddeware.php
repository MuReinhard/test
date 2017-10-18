<?php
namespace DesignPatternLaravel\Middeware;
use Closure;

/**
 * @class SessionMiddeware
 * @author ShiO
 */
class SessionMiddeware implements IMiddeware {
    /**
     * @author ShiO
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public static function handle($request, Closure $next) {
        echo '我是session的中间件' . '<br />';
        $next($request);
    }
}