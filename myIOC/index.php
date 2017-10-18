<?php
/**
 * @author ShiO
 * IOC实验性实现
 */

/**
 * 1.工厂类实现
 * 2.IOC容器实现
 * 3.MVC实现
 * 4.config实现
 * 5.入口类实现
 */

// 创建一个实际路径
define( 'root_path', substr( dirname( __file__ ), 0, - 7 ) );
// 加载系统配置文件
require root_path . '/configs/config.inc.php';
// 错误级别
error_reporting( error_report );

// 自动加载方法
function __autoload( $_className ) {
    if ( substr( $_className, - 6 ) == 'Action' ) { // 如果后缀为action，加载action文件
        require ROOT_PATH . '/action/' . $_className . '.class.php';
    } elseif ( substr( $_className, - 5 ) == 'Model' ) { // 如果后缀为model，加载model文件
        require ROOT_PATH . '/model/' . $_className . '.class.php';
    } elseif ( file_exists( ROOT_PATH . '/system/' . $_className . '.class.php' ) ) { // 如果是加载系统类库文件
        require ROOT_PATH . '/system/' . $_className . '.class.php';
    }
}

// 设置时区
date_default_timezone_set( TIMEZONE_SET );
// 设置编码
header( 'Content-Type:text/html;charset=' . BROWSER_CHARSET );
// 单入口部分
ActionFactory::setAction()->run(); // 通过控制器分发工厂得到控制器实例，并请求控制器下的run方法（action基类的run，基类的run方法负责分发请求具体的方法）