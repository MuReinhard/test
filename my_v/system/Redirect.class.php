<?php

/**
 * 跳转类
 */
class Redirect {
	// 用于存放本类对象的成员容器
	private static $_instance = null;
	// 用于存放模版对象的成员容器
	private $_tpl = null;

	// 私有克隆，防止被克隆
	private function __clone() {
	}

	// 获得DB单例对象
	public static function getInstance( &$_tpl ) {
		if ( ! self::$_instance instanceof self ) { // 如果容器中不存在本身对象，实例化一个新的
			self::$_instance = new self();
			self::$_instance->_tpl = $_tpl;
		}
		return self::$_instance; // 返回单例对象
	}

	// 私有构造方法
	private function __construct() {
	}

	/**
	 * 成功返回页面
	 * @Param string $_info 信息主体
	 * @Param string $_url 跳转路径
	 */
	public function success( $_info, $_url ) {
		$this->_tpl->assign( 'url', $_url );
		$this->_tpl->assign( 'message', $_info );
		$this->_tpl->display( SMARTY_SYSTEM . 'success.tpl' );
		exit();
	}

	/**
	 * 失败返回页面
	 * @Param string $_info 信息主体
	 * @Param string $_url 跳转路径（默认跳转上一页）
	 */
	public function error( $_info, $_url = 'prev' ) {
		if ( $_url == 'prev' ) {
			$_url = Tool::getPrevPage();
		}
		$this->_tpl->assign( 'url', $_url );
		$this->_tpl->assign( 'message', $_info );
		$this->_tpl->display( SMARTY_SYSTEM . 'error.tpl' );
		exit();
	}
}

?>