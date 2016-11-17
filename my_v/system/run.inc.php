<?php
// 创建一个实际路径
define( 'root_path', substr( dirname( __file__ ), 0, - 7 ) );
// 加载系统配置文件
require root_path . '/configs/config.inc.php';
// 错误级别
error_reporting( error_report );
// 开启session
if( SESSION_SWITCH === true) {
	session_start();
}
// 引入Smarty
require ROOT_PATH . '/smarty/Smarty.class.php';
// 自动加载方法
function __autoload( $_className ) {
	if ( substr( $_className, - 6 ) == 'Action' ) { // 如果后缀为action，加载action文件
		require ROOT_PATH . '/action/' . $_className . '.class.php';
	} elseif ( substr( $_className, - 5 ) == 'Model' ) { // 如果后缀为model，加载model文件
		require ROOT_PATH . '/model/' . $_className . '.class.php';
	} elseif ( substr( $_className, - 5 ) == 'Check' ) { // 如果后缀为check，加载check文件
		require ROOT_PATH . '/check/' . $_className . '.class.php';
	} elseif ( file_exists( ROOT_PATH . '/system/' . $_className . '.class.php' ) ) { // 如果是加载系统类库文件
		require ROOT_PATH . '/system/' . $_className . '.class.php';
	} elseif ( file_exists( ROOT_PATH . '/public/' . $_className . '.class.php' ) ) { //如果是加载公共库文件
		require ROOT_PATH . '/public/' . $_className . '.class.php';
	}
}

// 设置时区
date_default_timezone_set( TIMEZONE_SET );
// 设置编码
header( 'Content-Type:text/html;charset=' . BROWSER_CHARSET );
// 单入口部分
Factory::setAction()->run(); // 通过控制器分发工厂得到控制器实例，并请求控制器下的run方法（action基类的run，基类的run方法负责分发请求具体的方法）
?>