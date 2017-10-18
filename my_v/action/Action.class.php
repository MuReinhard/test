<?php

/**
 * 控制器基类
 */
class Action {
	protected $_tpl = null;                                                                       // 模版代理对象
	protected $_model = null;                                                                     // model对象容器
	protected $_redirect = null;                                                                  // 跳转对象容器

	protected function __construct( &$_model = null ) {
		$this->_tpl = TPL::getInstance(); // 得到模版代理对象
		$this->_model = $_model;                                                                // 得到指定的model对象
		$this->_redirect = Redirect::getInstance( $this->_tpl );              // 得到跳转页面对象
	}

	public function run() {
		$_m = isset( $_GET['m'] ) ? $_GET['m'] : 'index';                              // 默认调用方法为index
		// 判断是否存在请求的方法，如果存在执行，否则报错
		method_exists( $this, $_m ) ? eval( '$this->' . $_m . '();' ) : exit( '不存在名为' . $_m . '的方法' );
		// 为了用户友好，请求不存在的方法会被定向到index方法
//		method_exists($this,$_m) ? eval('$this->'.$_m.'();') : $this->index();
	}
}

?>