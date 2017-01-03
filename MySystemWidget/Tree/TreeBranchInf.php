<?php
namespace Tree;
/**
 * @class TreeBranch
 * @author ShiO
 */
interface TreeBranchInf extends TreeInf {
    /**
     * @author ShiO
     * @param TreeInf $tree
     * @return mixed
     */
    public function addChild(TreeInf $tree);

    /**
     * @author ShiO
     * @return mixed
     */
    public function getChilds();

    /**
     * @author ShiO
     * @return mixed
     */
    public function toArray();

}