<?php
	class IndexModel extends Model {
		public $_check = null;

		public function  __construct() {
			$this->_check = Factory::setCheck();
			parent::__construct();
		}

		public function findAllData() {
			$data = $this->table(array(DB_PREFIX.'manage'))->field(array('user'))->select(null, 'OBJ', false);
			return $data;
		}

	}

?>