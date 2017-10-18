<?php

class UserService {
	
	private $UserDao ;
	
	public function save($UserMode){
		$this->UserDao->save($UserMode) ;
	}
	/**
	 * @param $UserDao the $UserDao to set
	 */
	public function setUserDao($UserDao) {
		$this->UserDao = $UserDao;
	}

	
	
}

?>