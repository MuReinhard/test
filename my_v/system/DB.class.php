<?php

/**
 * 数据库连接类
 * 单例模式（继承）
 */
class DB {
	// PDO对象
	private $_pdo = null;
	// 用于存放本类对象的成员容器
	private static $_instance = null;

	// 私有克隆，防止被克隆
	private function __clone() {
	}

	// 获得DB单例对象
	protected static function getInstance() {
		if ( ! self::$_instance instanceof self ) { // 如果容器中不存在本身对象，实例化一个新的
			self::$_instance = new self();
		}
		return self::$_instance; // 返回单例对象
	}

	// 私有构造方法
	private function __construct() {
		try {
			// 尝试以PDO连接数据库
			$this->_pdo = new PDO( 'mysql:host=' . DB_DNS . ';dbname=' . DB_DATABASE_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHARSET) );
			// 设置数据库错误等级，以及获取方式（异常方式）
			$this->_pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			exit( $e->getMessage() );
		}
	}

	// 得到影响行数||刚刚新增的id||是否添加，删除，修改成功
	protected function row( $_sql, $_returnType = 'ROW' ) {
		$_stmt = $this->_pdo->prepare( $_sql );
		$_stmt = $this->execute( $_stmt, $_sql );
		$_result = null;
		switch ( $_returnType ) {
			case 'ROW' :
			{
				$_result = $_stmt->rowCount();
				break;
			}
			case 'INSERT_PK' :
			{
				$_result = $this->_pdo->lastInsertId();
				break;
			}
			case 'IF_FLAG' :
			{
				$_result = $_stmt->rowCount() > 0 ? true : false;
			}
		}
		return $_result;
	}

	// 得到结果集
	protected function fetch( $_sql, $_fetchType = 'ASSOC', $_HTMLFilter = true ) {
		$_stmt = $this->_pdo->prepare( $_sql );
		switch ( $_fetchType ) {
			case 'LAZY' :
			{
				$_fetchType = 1;
				break;
			}
			case 'ASSOC':
			{
				$_fetchType = 2;
				break;
			}
			case 'NUM':
			{
				$_fetchType = 3;
				break;
			}
			case 'BOTH':
			{
				$_fetchType = 4;
				break;
			}
			case 'OBJ':
			{
				$_fetchType = 5;
				break;
			}
		}
		$_stmt->setFetchMode( $_fetchType );
		$_stmt = $this->execute( $_stmt, $_sql );
		$_result = null;
		while ( ! ! $_t = $_stmt->fetch() ) {
			$_result[] = $_t;
		}
		if ( $_HTMLFilter ) {
			return $_result = Tool::setHtmlString( $_result );
		} else {
			return $_result;
		}
	}

	// 执行并返回执行后的句柄
	private function execute( $_stmt, $_sql ) {
		try {
			$_stmt->execute();
		} catch ( PDOException $e ) {
			exit( 'SQL语句：' . $_sql . '<br />错误信息：' . $e->getMessage() );
		}
		return $_stmt; // 返回执行后的句柄
	}

}

?>