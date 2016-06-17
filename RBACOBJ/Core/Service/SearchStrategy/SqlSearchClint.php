<?php
namespace Core\Service\SearchStrategy;

use Core\Config\AppConfig;
use Core\Service\Context\SearchSqlContext;
use Core\Message;
use Exception;
use Exception\SearchContextErrorException;
use Model\Model;

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
        try {
            $context = new SearchSqlContext();
            $context->setAccording($this->basisModel);
            $context->setMessageObj(new Message());
            $context->setConfigObj(AppConfig::getInstance());

            $modelSerch = new ModelSerch();
            $sqlFileSearch = new SqlFileSearch();

            $modelSerch->setHandle($sqlFileSearch);
            return $modelSerch->search($context);
        } catch (SearchContextErrorException $e) {
            echo $e->getFile();
            echo $e->getLine();
            echo $e->getMessage();
        }
    }

    /**
     * @author ShiO
     * @param Model $model
     */
    public function setBasisModel(Model $model) {
        $this->basisModel = $model;
    }
}