<?php
namespace DesignPatternLaravel\Middeware;
use Closure;

/**
 * @class IMiddware
 * @author ShiO
 */
interface IMiddeware {
    /**
     * @author ShiO
     * @param $request
     * @param Closure $closure
     * @return mixed
     */
    public static function handle($request, Closure $closure);
}