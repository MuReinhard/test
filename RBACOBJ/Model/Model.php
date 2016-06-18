<?php
namespace Model;

use Core\Service\SearchStrategy\SqlSearchClint;
use RBAC\CreateBranch;

/**
 * @class Model
 * @author ShiO
 */
class Model {
    protected $buildSql;

    /**
     * @author ShiO
     * @return mixed
     */
    public function getBuildSql() {
        return $this->buildSql;
    }

    /**
     * @author ShiO
     * @param mixed $buildSql
     */
    public function setBuildSql($buildSql) {
        $this->buildSql = $buildSql;
    }

    public function build() {
        // 1.检查表是否存在

        // 2.查找建表语句
        $search = new SqlSearchClint();
        $search->setBasisModel($this);
        $context = $search->searchSqlData();
        return $context->getResult();
    }

    /**
     * @author ShiO
     * @param $parent
     * @param $childArr
     * @return array
     */
    public function buildRelation($parent, $childArr) {
        $relationName = 'hi';
        $parent = new CreateBranch($relationName, $parent);
        foreach ($childArr as $value) {
            $parent->combination($value);
        }
        return $parent->create();
    }
}