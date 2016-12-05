<?php
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}
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


// ===============

//$context = new Context();
//$requst = new Request();
//new Auth($request,$context);

include_once 'Kernel.php';
include_once 'SystemReflectionClass.php';
include_once 'AuthContext.php';
include_once 'ContextInf.php';


$kernel = new Kernel();
$class = new SystemReflectionClass($kernel);
$class->init();
$requestResult = $class->getReflectionResult();
dump($requestResult);








