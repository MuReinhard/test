<?php
namespace Core\Service\SearchStrategy;
use Core\Service\Context\Context;

/**
 * @class SqlSerarch
 * @author ShiO
 */
abstract class Search {
    protected $nextSerarch;

    /**
     * @author ShiO
     * @param Search $serarch
     */
    public function setHandle(Search $serarch) {
        $this->nextSerarch = $serarch;
    }

    /**
     * @author ShiO
     * @param $context
     * @return mixed
     */
    abstract public function search(Context $context);
}