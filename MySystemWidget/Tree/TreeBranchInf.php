<?php
namespace MySystemWidget\Tree;
/**
 * @class TreeBranch
 * @author ShiO
 */
interface TreeBranchInf extends TreeInf{
    /**
     * @author ShiO
     * @param TreeInf $tree
     * @return mixed
     */
    public function add(TreeInf $tree);

    /**
     * @author ShiO
     * @param TreeInf $tree
     * @return mixed
     */
    public function getTrees(TreeInf $tree);

}