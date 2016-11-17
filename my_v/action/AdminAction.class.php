<?php
    class AdminAction extends Action {
        public function __construct() {
            parent::__construct();
        }
        // 后台初始页面
        public function index() {
            $this->_tpl->display(SMARTY_ADMIN.'public/admin.tpl');
        }
        // 后台主页面
        public function main() {
            $this->_tpl->display(SMARTY_ADMIN.'public/admin_main.tpl');
        }
    }
?>