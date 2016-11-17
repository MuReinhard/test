<?php

/**
 * HTTP请求类
 * 负责处理POST请求数据，发送到相应的check对象之中
 * 单例模式
 */
class Request {
	// 用于存放本类对象的成员容器
	static private $_instance = null;

	// 私有克隆，防止被克隆
	private function __clone() {
	}

	// 获得DB单例对象
	public static function getInstance() {
		if ( ! self::$_instance instanceof self ) { // 如果容器中不存在本身对象，实例化一个新的
			self::$_instance = new self();
		}
		return self::$_instance; // 返回单例对象
	}

	// 私有构造方法
	private function __construct() {
	}

	//获取新增和修改的字段，请求的类型是post还是get
	public function filter( Array $_fields, $_type = 'POST' ) {
		$_data = array();

		if ( $_type == 'POST' ) {
			$_requestData = $_POST;
		}
		if ( $_type == 'GET' ) {
			$_requestData = $_GET;
		}

		if ( Validate::isArray( $_requestData ) && ! Validate::isNullArray( $_requestData ) ) {
			foreach ( $_requestData as $_key => $_value ) {
				if ( Validate::inArray( $_key, $_fields ) ) {
					$_data[$_key] = $_value;
				}
			}
		}
		return $_data;
	}

	// 转义html字符
	public function requestHtmlFilter() {
		$_POST = Tool::setHtmlString( $_POST );
		$_GET = Tool::setHtmlString( $_GET );
	}

	// 转义入库特殊符号
	public function requestDBFilter() {
		$_POST = Tool::setFormString( $_POST );
		$_GET = Tool::setFormString( $_GET );
	}
}

?>