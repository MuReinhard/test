<?php
namespace Model;

use Core\Service\SearchStrategy\SqlSearchClint;
use RBAC\CreateBranch;

/**
 * @class Model
 * @author ShiO
 */
class Model {
    const RELATION_TYPE_MANY_TO_MANY = 1;
    const RELATION_TYPE_ONE_TO_MANY = 1;
    const RELATION_TYPE_MANY_TO_ONE = 1;
    /**
     * @author ShiO
     */
    public function saveToDB() {

    }

    /**
     * @author ShiO
     * @return $this
     */
    public function findData() {
        return $this;
    }

    /**
     * @author ShiO
     * @return int
     */
    public function getPk() {
        return 1;
    }

}