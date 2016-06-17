<?php
namespace Core\Service\SearchStrategy;

use Core\Db\Service\SearchStrategy\Search;
use Core\File\SqlFileLookers;
use Exception\SearchContextErrorException;

/**
 * @class SqlFileSearch
 * @author ShiO
 */
class SqlFileSearch extends Search {

    /**
     * @author ShiO
     * @param $context
     * @throws SearchContextErrorException
     */
    public function search($context) {
        if (!$context->according) {
            throw new SearchContextErrorException();
        } else {
             $sqlFile = new SqlFileLookers($context->according);
            //TODO:: sss
             $sqlFile
        }
    }
}