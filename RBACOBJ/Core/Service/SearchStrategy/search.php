<?php
namespace Core\Db\Service\SearchStrategy;

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

    abstract public function search($context);
}