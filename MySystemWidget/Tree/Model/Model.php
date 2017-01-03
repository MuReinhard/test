<?php
namespace Tree\Model;
use Tree\Db\DB;

/**
 * @class Model
 * @author ShiO
 */
class Model extends DB{
    protected $_db = null; // db类成员容器
    protected $_check = null; // check验证类容器
    protected $_request = null; // 请求类容器

    private $_tables = null; // 表名容器
    private $_fields = null; // 字段容器
    private $_data = array(); // 数据容器
    private $_sql = null; // sql语句容器
    private $_lastSql = null; // 最后一条sql语句容器

    public function __construct() {
        $this->_db = parent::getInstance(); // 得到父类（DB）的对象，放入成员容器中
        $this->_request = Request::getInstance();
    }

    /**
     * 组成select语句
     * @param null $_sql 如果填入此参数，则直接使用指定的sql语句
     * @param string $_fetchType 查询返回结果的类型
     * @param bool $_HTMLFilter 是否使用html过滤结果
     * @return array|null|string 返回结果
     */
    protected function select( $_sql = null, $_fetchType = 'ASSOC', $_HTMLFilter = true ) {
        if ( $_sql === null ) {
            $this->_sql = 'select ' . $this->_fields . ' from ' . $this->_tables . $this->_sql;
        } else {
            $this->_sql = $_sql; 	// 直接使用传入的sql
        }
        $_result = $this->_db->fetch( $this->_sql, $_fetchType, $_HTMLFilter );
        $this->restore(); 			// 清除所有sql组装痕迹
        return $_result;
    }

    /**
     * 分解表名，并赋予别名
     * @param Array $_tables 表名 array('别名','表名','别名','表名')
     * @return Object $this 本类对象
     * 处理结果：表名 别名,表名 别名
     */
    protected function tableAs( $_tables ) {
        foreach ( $_tables as $_key => $_value ) {
            $this->_tables = $this->_tables . ",`" . $_value . "`" . ' ' . $_key; //$_key = 别名，$_value = 表名
        }
        $this->_tables = substr( $this->_tables, 1 ); 							  // 截取第一个,
        return $this;
    }

    /**
     * 分解字段，并赋予别名
     * @param Array $_fields 字段 array('别名1','字段1,字段2..','别名2','字段1,字段2...')
     * @return String $this
     * 处理结果：字段.别名1,字段.别名1...,字段.别名2,字段.别名2...
     */
    protected function fieldAs( $_fields ) {
        $_fieldsArr = array();
        foreach ( $_fields as $_key => $_value ) {
            $_fieldsArr = explode( ',', $_value );
            for ( $i = 0; $i < sizeof( $_fieldsArr ); $i ++ ) {
                $this->_fields = $this->_fields . ',' . $_key . ".`" . $_fieldsArr[$i] . "`"; // $_key = 别名 $_fieldsArr[$i] = 字段名
            }
        }
        $this->_fields = substr( $this->_fields, 1 ); // 截取第一个
        return $this;
    }

    /**
     * 组成查询条件
     * @param String $where 查询条件
     * @return Object $this 本类对象
     */
    protected function where( $where ) {
        $this->_sql = $this->_sql . ' where ' . $where;
        return $this;
    }

    /**
     * 排序条件
     * @param String $_fields 字段
     * @param Int $isType 排序类型（1，正序,2，倒序）
     * @return Object $this 本类对象
     */
    protected function order( $_fields, $isType ) {
        $type = null;

        if ( $isType == 1 ) {
            $type = ' ASC ';
        }

        if ( $isType == 2 ) {
            $type = ' DESC ';
        }

        $this->_sql = $this->_sql . ' order by ' . $_fields . ' ' . $type;
        return $this;
    }

    /**
     * limit组成
     * @param Int $limitStart limit开始位置
     * @param Int $limitEnd limit条数
     * @return Object $this 本类对象
     */
    protected function limit( $limitStart, $limitEnd ) {
        $this->_sql = $this->_sql . 'limit ' . $limitStart . ',' . $limitEnd;
        return $this;
    }

    /**
     * 组成表名，不使用别名
     * @param Array $_tables 表名 $_tables['别名']
     * @return Object $this
     */
    protected function table( $_tables ) {
        foreach ( $_tables as $_value ) {
            $this->_tables = $this->_tables . ",`" . $_value . "`"; // $_value = 表名
        }
        $this->_tables = substr( $this->_tables, 1 ); // 截取第一个,
        return $this;
    }

    /**
     * 组成字段，不使用别名
     * @param Array $_fields 字段名 $_tables['别名']
     * @return Object $this
     */
    protected function field( $_fields ) {
        $_fieldsArr = array();
        foreach ( $_fields as $_value ) {
            $_fieldsArr = explode( ',', $_value );
            for ( $i = 0; $i < sizeof( $_fieldsArr ); $i ++ ) {
                $this->_fields = $this->_fields . "," . $_fieldsArr[$i] . ""; // $_key = 别名 $_fieldsArr[$i] = 字段名
            }
        }
        $this->_fields = substr( $this->_fields, 1 ); // 截取第一个
        return $this;
    }

    /**
     * 组成添加数据
     * @param Array $data 添加数据 $data = array(数据1,数据2...)
     * @return Object $this
     */
    protected function data( $data ) {
        $this->_data = $data;
        return $this;
    }

    /**
     * 开始计数
     * @param String $where 指定字段计数，默认为所有
     * @return String $sql sql语句成员
     */
    protected function count( $asField = 'count_t', $_fetchType = 'ASSOC' ) {
        $this->_sql = "select count(1) as {$asField} from {$this->_tables}" . $this->_sql;
        $_data = $this->_db->fetch( $this->_sql, $_fetchType, $_HTMLFilter = true );
        $this->restore();
        return $_data[0][$asField];
    }

    /**
     * @param null $_sql 如果填入此参数，则直接使用指定的sql语句
     * @param string $_returnType 返回类型
     * @return bool|int|null|string
     */
    protected function add( $_sql = null, $_returnType = 'ROW' ) {
        if ( $_sql === null ) {
            $_addSql = $this->addDataHandle();
            $this->_sql = "insert into " . $this->_tables . $_addSql . $this->_sql;
        } else {
            $this->_sql = $_sql; // 直接使用sql
        }
        $_result = $this->_db->row( $this->_sql, $_returnType );
        $this->restore();
        return $_result;
    }

    /**
     * 处理传入的data为正确添加的格式
     * @return String $addSql 处理过后的添加语句值的部分
     */
    private function addDataHandle() {
        $_fields = null;
        $_data = null;

        foreach ( $this->_data as $_key => $_value ) {
            $_fields = $_fields . ',' . $_key;
            $_data = $_data . ',' . "'" . $_value . "'";
        }
        $_fields = substr( $_fields, 1 );
        $_data = substr( $_data, 1 );

        $_addSql = '(' . $_fields . ') values (' . $_data . ') ';
        return $_addSql;
    }

    /**
     * @param null $_sql 如果填入此参数，则直接使用指定的sql语句
     * @param string $_returnType 返回类型
     * @return bool|int|null|string
     */
    protected function save( $_sql = null, $_returnType = 'ROW' ) {
        if ( $_sql === null ) {
            $_saveSql = $this->saveDataHandle();
            $this->_sql = 'update ' . $this->_tables . ' set ' . $_saveSql . $this->_sql;
        } else {
            $this->_sql = $_sql;
        }
        $_result = $this->_db->row( $this->_sql, $_returnType );
        $this->restore();
        return $_result;
    }

    /**
     *处理传入的data为正确修改的格式
     * @return String $saveSql 处理过后的修改语句值的部分
     */
    private function saveDataHandle() {
        $_sql = null;
        foreach ( $this->_data as $_key => $_value ) {
            $_sql = $_sql . ',' . $_key . "='" . $_value . "'";
        }
        $_saveSql = substr( $_sql, 1 );
        return $_saveSql;
    }

    /**
     * @param null $_sql 如果填入此参数，则直接使用指定的sql语句
     * @param string $_returnType 返回类型
     * @return bool|int|null|string
     */
    protected function delete( $_sql = null, $_returnType = 'ROW' ) {
        if ( $_sql === null ) {
            $this->_sql = 'delete from ' . $this->_tables . ' ' . $this->_sql;
        } else {
            $this->_sql = $_sql;
        }
        $_data = $this->_db->row( $this->_sql, $_returnType );
        $this->restore();
        return $_data;
    }

    /**
     * 得到最后一条sql语句
     */
    protected function getLastSql() {
        return $this->_lastSql;
    }

    /**
     * 重新初始化方法，封存最后一条sql，执行清空
     */
    protected function restore() {
        $this->_lastSql = $this->_sql; // 储存最后一条sql语句
        $this->_tables = null; // 表名容器
        $this->_fields = null; // 字段容器
        $this->_data = array(); // 数据容器
        $this->_sql = null; // sql语句容器
    }
}