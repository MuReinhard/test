<?php
namespace Core\Service\SearchStrategy;
use Model;

/**
 * @class SqlSearch
 * @author ShiO
 */
class SqlSearchClint {
    public $basisModel;

    /**
     * @author ShiO
     */
    public function searchSqlData() {
    }

    /**
     * @author ShiO
     * @param Model $model
     */
    public function setBasisModel(Model $model) {
        $this->basisModel = $model;
    }
}