<?php
use DesignPatternLaravel\Croe\Pipeline;
use DesignPatternLaravel\Croe\Request;

require_once 'IMiddeware.php';
require_once 'CookieMiddeware.php';
require_once 'SessionMiddeware.php';
require_once 'Pipeline.php';
/**
 * @author ShiO
 * @return Closure
 */
function dispatchToRouter() {
    return function ($request) {
        echo $request.'发送请求！！！'. '<br />';
    };
}

$request = new Request();
$middlewares = [
    SessionMiddeware::class,
    CookieMiddeware::class,
];
(new Pipeline())->send($request)->through($middlewares)->then(dispatchToRouter());