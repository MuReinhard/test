<?php
/**
 * @author ShiO
 */
/*

分居方：
1.资源所有者
2.授权服务器
3.资源服务器

OAuth授权步骤分解：
1.客户端向服务器获取AuthCode
2.

类设计：
A 用户授权信息类
AA 用户静默授权信息类
BB 用户网页授权信息类



*/

$login = new Login();
$application = new Application();

$context = new Context();
$context->setConfig(new Config());

$request = new Request();
$request->setGet($_GET);

// ===============

$auth = new Auth($login, $application);
$baseAuth = new BaseAuth($login, $application);
if ($request['scope'] == RequestCodeModel::SNSAPI_BASE) {
    $fAuth = new SilentAuth($login, $application);
} else {
    $fAuth = new WebAuth($login, $application);
}
$auth->setHandle($baseAuth);
$baseAuth->setHandle($fAuth);
$auth->auth($request, $context);
