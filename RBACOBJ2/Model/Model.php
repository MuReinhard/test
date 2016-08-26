<?php
namespace Model;

use Db\AutoSqlTrait;
use Db\Db;

/**
 * @class Model
 * @author ShiO
 */
class Model extends Db{
    use AutoSqlTrait;

    const RELATION_TYPE_MANY_TO_MANY = 1;
    const RELATION_TYPE_ONE_TO_MANY = 2;
    const RELATION_TYPE_MANY_TO_ONE = 3;

    protected $_db = null; // db类成员容器

    /**
     * @author ShiO
     * Model constructor.
     */
    protected function __construct() {
        $this->_db = parent::getInstance(); // 得到父类（DB）的对象，放入成员容器中
    }

    /**
     * @author ShiO
     * @param $key
     * @param $value
     */
    protected function setPk($key, $value) {
        $this->$key = $value;
    }

    /**
     * @author ShiO
     * @param $data
     */
    protected function modelBean($data) {
        foreach ($data[0] as $key => $value) {
            $this->$key = $value;
        }
    }
}