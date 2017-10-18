<?php
// 系统配置
define( 'TIMEZONE_SET', 'Asia/Shanghai' );                                            // 设置时区
define( 'ERROR_REPORT', E_ALL );                                                            // 设置错误级别
define( 'BROWSER_CHARSET' , 'utf-8');                                                   // 设置浏览器编码
define( 'SESSION_SWITCH' , true);                                                           // 是否开启SESSION

// smarty配置文件，样式替换
define( 'SMARTY_FRONT', 'default/' );                                                     // 默认皮肤
define( 'SMARTY_ADMIN', 'admin/' );                                                      // 后台皮肤
define( 'SMARTY_SYSTEM', 'system/' );                                                   // 系统页面

// 数据库连接参数
define( 'DB_DNS', 'localhost' );                                                                  // 地址
define( 'DB_USER', 'root' );                                                                         // 用户名
define( 'DB_PASS', 'root' );                                                                                 // 密码
define( 'DB_DATABASE_NAME', 'my' );                                                    // 库名
define( 'DB_CHARSET', 'UTF8' );                                                                // 字符编码
define( 'DB_PREFIX', 'my_' );                                                                       // 数据库表前缀

// smarty配置参数
define( 'SMARTY_TEMPLATE_DIR', ROOT_PATH . '/view/' );                // 模板目录
define( 'SMARTY_COMPILE_DIR', ROOT_PATH . '/compile/' );            // 编译目录
define( 'SMARTY_CONFIG_DIR', ROOT_PATH . '/configs/' );                // 配置变量目录
define( 'SMARTY_CACHE_DIR', ROOT_PATH . '/cache/' );                    // 缓存目录
define( 'SMARTY_CACHING', 1 );                                                              // 是否开启缓存，网站开发调试阶段，我们应该关闭缓存
define( 'SMARTY_CACHE_LIFETIME', 60 * 60 * 24 );                              // 缓存的声明周期
define( 'SMARTY_LEFT_DELIMITER', '{' );                                                 // 左定界符
define( 'SMARTY_RIGHT_DELIMITER', '}' );                                              // 右定界符

?>