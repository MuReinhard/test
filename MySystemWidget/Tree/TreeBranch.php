<?php
namespace MySystemWidget\Tree;
/**
 * @class TreeBranch
 * @author ShiO
 */
class TreeBranch implements TreeBranchInf {
    private $bean;
    private $trees = array();

    public function __construct($bean) {
        $this->bean = $bean;
    }

    /**
     * @author ShiO
     * @param TreeInf $tree
     * @return mixed
     */
    public function getTrees(TreeInf $tree) {
        return $this->trees;
    }

    /**
     * @author ShiO
     * @param TreeInf $tree
     * @return mixed
     */
    public function add(TreeInf $tree) {
        $this->trees[] = $tree;
    }


    /**
     * @author ShiO
     * @return mixed
     */
    public function getBean() {
        return $this->bean;
    }
}