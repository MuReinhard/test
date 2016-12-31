<?php
namespace Tree;
/**
 * @class TreeItem
 * @author ShiO
 */
class TreeItem implements TreeItemInf {
    private $bean;

    /**
     * @author ShiO
     * TreeItem constructor.
     * @param $bean
     */
    public function __construct($bean) {
        $this->bean = $bean;
    }


    /**
     * @author ShiO
     * @return mixed
     */
    public function getBean() {
        return $this->bean;
    }
}