<?php
namespace Core\Service\SearchStrategy;

use Core\Service\Context\Context;
use Exception\SearchContextErrorException;


/**
 * @class ModelSerch
 * @author ShiO
 */
class ModelSerch extends Search {
    /**
     * @author ShiO
     * @param Context $context
     * @return mixed
     * @throws SearchContextErrorException
     */
    public function search(Context $context) {
        if (!$context->getAccording()) {
            throw new SearchContextErrorException($context->getMessageObj());
        }
        $according = $context->getAccording();
        $sql = $according->getBuildSql();
        if ($sql) {
            $context->setResult($sql);
            $context->getMessageObj()->setMessage($context->getConfigObj()->findConfig('MESSAGE', '200'));
            return $context;
        }
        if (isset($this->nextSerarch)) {
            return $this->nextSerarch->search($context);
        } else {
            $context->getMessageObj()->setMessage($context->getConfigObj()->findConfig('MESSAGE', '300'));
            return $context;
        }
    }
}