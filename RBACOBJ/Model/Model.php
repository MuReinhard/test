<?php
namespace Model;
use Core\Service\SearchStrategy\SqlSearchClint;

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
        $search = new SqlSearchClint();
        $search->setBasisModel($this);
        $context = $search->searchSqlData();
        echo $context->getResult();
    }
}