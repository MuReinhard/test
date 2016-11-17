<?php

class ManageAction extends Action {
	public function __construct() {
		parent::__construct( Factory::setModel() );
	}

	// 管理员列表
	public function index() {
		$_page = new PageUtil( 10, '?a=manage&m=index' );
		$_page->setPageNum();
		$data = $this->_model->findAllManageUsePage( $_page );
		$_pageArr = $_page->show( 'A', '&' );

		print_r( $_pageArr );
		print_r( $data );

		$this->_tpl->display( SMARTY_ADMIN . 'manage/manage.tpl' );
	}

	// 添加管理员
	public function addOne() {
		if ( isset( $_POST['send'] ) ) {
			if ( $this->_model->addOne() ) {
				// 如果新增成功，跳转到成功提示页
				$this->_redirect->success( '新增管理员成功', '?a=manage' );
			} else {
				// 如果新增失败
				$this->_redirect->error( '新增管理员失败' );
			}
		}
		$this->_tpl->display( SMARTY_ADMIN . 'manage/add.tpl' );
	}
}

?>