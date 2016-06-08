<?php
class UserMode{
		
	private $username ;
		
	private $password ;
		/**
	 * @return the $username
	 */
	public function getUsername() {
		return $this->username;
	}

		/**
	 * @return the $password
	 */
	public function getPassword() {
		return $this->password;
	}

		/**
	 * @param $username the $username to set
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

		/**
	 * @param $password the $password to set
	 */
	public function setPassword($password) {
		$this->password = $password;
	}
}
?>