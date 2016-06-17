<?php
namespace Core\Service\SearchStrategy;

use Core\File\File;
use Core\File\SqlFileLookers;
use Core\Service\Context\Context;
use Exception\SearchContextErrorException;

/**
 * @class SqlFileSearch
 * @author ShiO
 */
class SqlFileSearch extends Search {

    /**
     * @author ShiO
     * @param $context
     * @return resource
     * @throws SearchContextErrorException
     */
    public function search(Context $context) {
        if (!$context->getAccording()) {
            throw new SearchContextErrorException($context->getMessageObj());
        }
        $path = $context->getConfigObj()->findConfig('SQL_PATH');
        $model = $context->getAccording();
        $modelName = get_class($model);

        $sql = new SqlFileLookers(new File($path . $modelName));
        $data = $sql->getData();
        if ($data) {
            $context->setResult($data);
            $context->getMessageObj()->setMessage($context->getConfigObj()->findConfig('MESSAGE', '200'));
            return $context;
        }
        if (isset($this->nextSerarch)) {
            $this->nextSerarch->search($context);
        } else {
            $context->getMessageObj()->setMessage($context->getConfigObj()->findConfig('MESSAGE', '300'));
            return $context;
        }
    }
}