<?php

class IndexAction extends Action {
	public function __construct() {
		parent::__construct(new IndexModel()); // 执行父类构造
	}

	public function index() {

//		$data =  $this->_model->findAllData();

//		$data = Tool::setHtmlString($data);
//		print_r($data);
		$this->_tpl->assign( 'name', '首页' );
		$this->_tpl->display( SMARTY_FRONT . '/public/index.tpl' );
	}
}

?>