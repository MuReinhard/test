<?php
namespace Admin\Core\Service\SearchStrategy;

use Core\Db\Service\SearchStrategy\Search;
use Model\Model;

/**
 * @class ModelSerch
 * @author ShiO
 */
class ModelSerch extends Search {
    public $basisModel;

    /**
     * @author ShiO
     * @param Model $model
     */
    public function setBasisModel(Model $model) {
        $this->basisModel = $model;
    }

    /**
     * @author ShiO
     */
    public function search() {
        if ($this->basisModel->buildSql) {

        } elseif(isset($this->nextSerarch)) {
            $this->nextSerarch->search();
        }
    }

    public function __construct($context) {
        parent::__construct($context);
    }
}