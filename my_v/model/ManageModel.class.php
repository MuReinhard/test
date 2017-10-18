<?php

class ManageModel extends Model {
	public $_check = null;

	public function __construct() {
		$this->_check = Factory::setCheck();                                               // 通过url得到check对象
		parent::__construct();
	}

	public function findAllManageUsePage( $_page ) {
		$_tables = array('manage' => DB_PREFIX . 'manage');
		$_fields = array('manage' => 'user,pass');
		$_count = $this->table( $_tables )->count();
		$_page->setCount( $_count );
		$_data = $this->table( $_tables )->field( $_fields )->limit( $_page->_limitStart, $_page->_limitEnd )->select();
		return $_data;
	}

	public function addOne() {
		$_fields = array('user', 'pass');
		if ( ! $this->_check->check( $this ) ) {
			$this->_check->error();
		}
		$this->_request->requestDBFilter();                                               // 过滤post与get请求中的特殊字符
		$this->_request->requestHtmlFilter();                                           // 过滤post与get请求中的html字符

		$_addData = $this->_request->filter( $_fields );                           // 过滤多余字段

		$_addData['pass'] = sha1( $_addData['pass'] );
		$_addData['last_ip'] = Tool::getIP();
		$_addData['reg_time'] = Tool::getDate();
		$addIf = $this->table( array('manage' => DB_PREFIX . 'manage') )->data( $_addData )->add();
		return $addIf;
	}

	public function isOne() {
		$_data = $this->table( array('manage' => DB_PREFIX . 'manage') )->field( array('manage' => 'user') )->where( "user='" . $_POST['user'] . "'" )->select();
		if ( $_POST['user'] == $_data[0]['user'] ) {
			return false;
		} else {
			return true;
		}
	}
}

?>