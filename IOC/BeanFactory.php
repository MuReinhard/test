<?php
class BeanFactory {
	private static $app ; // application.xml文件解析对象
	private static $includeFile = false ;
	/**
	 * @param String $filePath 配置文件路径 
	 * @author ChenGang  2009-12-19  下午01:55:11
	 */
	public static function init($filePath , $hostPath){
		if(!$hostPath)
			$hostPath = "/" ;
		
		/*获取application.xml解析后的对象*/
		self::$app = new applicationXMLforObject($filePath) ;
		/*动态引入类所在PHP文件地址*/
		foreach (self::$app->getBeanConfigList("bean") as $o) {
			$classPath = $o->getClass() ;
			include_once($hostPath.$classPath);
		}
		/*引入成功 做 php 文件引入成功 标志*/
		self::$includeFile = true ;
	}
	
	/**
	 * 获取想要的对象通过 指定 类的名字
	 * 想要从application.xml文件描述的类中获得想要的对象
	 * 
	 * @package String $className 类的名字（bean的id值）
	 */
	public static function getNewBeanByName($className) {
		if(!self::$includeFile)
			return ;
		/*遍历applicaion.xml配置文件，查看是否存在与$className匹配的id的值*/
		if(!self::$app->getBeanConfig($className)) 
			return ;
		$refle = new ReflectionClass ($className);
		$beanObj = self::newObj($refle) ;
		/*通过setter方法注入需要的对象*/
		$s = $refle->getMethods(); //拿到 所有的方法
		for($i = 0 ; $i < count($s) ; $i++){
			$tempMethodName = $s[$i]->getName() ; //得到 每一个 方法的 名字
			if ($s[$i]->isPublic()) {
				 if(preg_match("/^(set)/" , $tempMethodName)){ //过滤出 需要的 setter方法
				 	$tempBeanId = substr($tempMethodName , 3) ; //拿到需要的 id
				 	$ro = new ReflectionClass ($beanObj);
				 	$method = $ro->getMethod($tempMethodName) ;
				 	$method->invoke ( $beanObj, self::getNewBeanByName($tempBeanId) );
				 }
			}
		}
		/*通过setter方法注入需要的对象*/
		return $beanObj ;
	}

	/**
	 * 创建对象 指定id 所对应的类的对象
	 * @param $refle $refle = new ReflectionClass ($className);
	 * @return BeanObj / false;
	 * @throws Exception
	 */
	private static function newObj($refle){
		try {
			if ($refle->isInstantiable ()) {
				return $refle->newInstance ();
			}
			else{
				return false ;
			}
		} catch (Exception $e) {
			throw new Exception($e."  没有引入类文件！") ;
		}
	}
}

/**
 * 执行指定类的指定方法
 */
class ClassOneDelegator {
	private $targets;
	function __construct($obj) {
		$this->target [] = $obj;
	}
	function __call($name, $args) {
		foreach ( $this->target as $obj ) {
			$r = new ReflectionClass ( $obj );
			if ($method = $r->getMethod ( $name )) {
				if ($method->isPublic () && ! $method->isAbstract ()) {
					return $method->invoke ( $obj, $args );
				}
			}
		}
	}
}
/**
 * bean标签对应的实体
 * @author ai_zxc
 *
 */
class BeanConfig{
	private $id ;
	private $class ;
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}
	/**
	 * @return the $class
	 */
	public function getClass() {
		return $this->class;
	}
	/**
	 * @param $id the $id to set
	 */
	public function setId($id) {
		$this->id = $id;
	}
	/**
	 * @param $class the $class to set
	 */
	public function setClass($class) {
		$this->class = $class;
	}
}

/**
 * 解析指定的XML配置文件
 * @author ai_zxc
 *
 */
class applicationXMLforObject {
	private $filePath ;
	private $xml ;
	private $beanConfig ;
	private static $arr = null;

	/**
	 * 构造函数
	 * @param $filePath 指定XML配置文件路径
	 * @throws Exception
	 */
	function __construct($filePath) {
		if(file_exists($filePath)){
			$this->filePath = $filePath ;
			$this->xml = new DOMDocument();
			$this->xml->load($filePath) ;
		}
		else{
			$o = new ReflectionClass("applicationXMLforObject") ;
			throw new Exception(" [ ".$o->getName()." 找不到要解析XML文件  ] ") ;
		}
	}
	/**
	 * 通过配置文件中标签bean的属性id获得一个对应的实体bean
	 * @return the $beanConfig
	 */
	public function getBeanConfig($beanId) {
		if(self::$arr) {
			return self::$arr[$beanId] ;
		}
		self::$arr = $this->getBeanConfigList("bean");
		return self::$arr[$beanId] ;
	}

	/**
	 * 获得所有bean标签的实体对象
	 * @param unknown_type $tag
	 * @return array
	 */
	public function getBeanConfigList($tag){
		// 获取所有的$tag标签
		$tagDom = $this->xml->getElementsByTagName($tag);    
		$arr = array() ;
		foreach($tagDom as $node){
			$this->beanConfig = new BeanConfig() ;
			if($node->attributes->item(0)->nodeName == "id" && $node->attributes->item(1)->nodeName == "class"){
				$this->beanConfig->setId($node->attributes->item(0)->nodeValue) ;
				$this->beanConfig->setClass($node->attributes->item(1)->nodeValue) ;
				$arr[$node->attributes->item(0)->nodeValue] = $this->beanConfig ;
			}
		}
		return $arr ;
	}
}
?>
