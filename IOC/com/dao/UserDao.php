<?php

class UserDao {

	public function save($UserMode){
		echo "<pre>" ;
		echo "UserDao 保存用户 ".$UserMode->getUsername()." 成功！" ;		
		echo "</pre>" ;
	}
	
}

?>