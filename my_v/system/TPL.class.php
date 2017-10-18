<?php

/**
 * tpl是smarty模版的代理类，继承smarty类，并配置模版
 * 使用单例模式（且不能被克隆）
 */
class TPL extends Smarty {
	// 用于存放本类对象的成员容器
	static private $_instance;

	// 引入配置方法，私有构造方法，以完成单例
	private function __construct() {
		parent::Smarty(); // 执行smarty中的构造方法
		$this->setConfigs();
	}

	// 私有克隆，防止被克隆
	private function __clone() {
	}

	// 获得TPL单例对象
	public static function getInstance() {
		if ( ! self::$_instance instanceof self ) { // 如果容器中不存在本身对象，实例化一个新的
			self::$_instance = new self();
		}
		return self::$_instance; // 返回单例对象
	}

	// 配置smarty文件
	private function setConfigs() {
		// 模板目录
		$this->template_dir = SMARTY_TEMPLATE_DIR;
		// 编译目录
		$this->compile_dir = SMARTY_COMPILE_DIR;
		// 配置变量目录
		$this->config_dir = SMARTY_CONFIG_DIR;
		// 缓存目录
		$this->cache_dir = SMARTY_CACHE_DIR;
		// 是否开启缓存，网站开发调试阶段，我们应该关闭缓存
		$this->caching = SMARTY_CACHING;
		// 缓存的声明周期
		$this->cache_lifetime = SMARTY_CACHE_LIFETIME;
		// 左定界符
		$this->left_delimiter = SMARTY_LEFT_DELIMITER;
		// 右定界符
		$this->right_delimiter = SMARTY_RIGHT_DELIMITER;
	}
}

?>