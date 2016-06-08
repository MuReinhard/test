<?php
include_once '/MyProject_for_PHP/TestStringForPHP/BeanFactory.php';

BeanFactory::init("applicationContext.xml" , "/MyProject_for_PHP") ;
$loginAction = BeanFactory::getNewBeanByName("LoginAction") ;
$url = $loginAction->execute($_POST) ;

echo "<pre>" ;
echo "页面将要跳转到 ".$url."页面！";
echo "</pre>" ;



class LoginAction{
		
	private $UserMode ;
	
	private $UserService ;
	
	public function execute($post=null , $get = null , $request=null) {
		
		$this->UserMode->setUsername($post['username']) ;
		$this->UserMode->setPassword($post['password']) ;
		
		if($this->UserService->save($this->UserMode)){
			return "succese.php" ;
		}
		else{
			return "input.php" ;
		}
		
	}
	
	/**
	 * @param $UserMode the $UserMode to set
	 */
	public function setUserMode($UserMode) {
		$this->UserMode = $UserMode;
	}
	/**
	 * @param $UserService the $UserService to set
	 */
	public function setUserService($UserService) {
		$this->UserService = $UserService;
	}

	
	
		
}

?>