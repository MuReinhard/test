<?php
    // 验证基类
    class Check extends Validate {
        protected $_flag = true;            // 判断验证是否通过
        protected $_message = array();      // 错误消息集
        // 模版对象
        private $_tpl = null;
        private $_redirect = null;
        // 初始化
        public function __construct() {
            $this->_tpl = TPL::getInstance();
            $this->_redirect = Redirect::getInstance( $this->_tpl );
        }
        // 错误发生跳转页面方法
        public function error() {
            $this->_redirect->error( $this->_message, Tool::getPrevPage() );
            exit();
        }
        // 获取消息集
        public function getMessage() {
            return $this->_message;
        }
    }
?>