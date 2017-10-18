<?php

// 管理员验证类
class ManageCheck extends Check {
	public function check( &$_model ) {
		if ( self::isNullString( $_POST['user'] ) ) {
			$this->_message[] = '管理员用户名不能为空!';
			$this->_flag = false;
		}
		if ( self::checkStrLength( $_POST['user'], 2, 'min' ) ) {
			$this->_message[] = '管理员用户名不能小于2位!';
			$this->_flag = false;
		}
		if ( self::checkStrLength( $_POST['user'], 20, 'max' ) ) {
			$this->_message[] = '管理员用户名不能大于20位!';
			$this->_flag = false;
		}
		if ( self::checkStrLength( $_POST['pass'], 6, 'min' ) ) {
			$this->_message[] = '密码不能小于6位!';
			$this->_flag = false;
		}
		if ( ! self::checkStrEquals( $_POST['pass'], $_POST['notpass'] ) ) {
			$this->_message[] = '密码与确认密码不一致!';
			$this->_flag = false;
		}
		if ( self::isNullString( $_POST['level'] ) ) {
			$this->_message[] = '管理员权限必须选择!';
			$this->_flag = false;
		}
		if ( ! $_model->isOne() ) {
			$this->_message[] = '管理员用户名不能重复!';
			$this->_flag = false;
		}
		return $this->_flag;
	}
}

?>