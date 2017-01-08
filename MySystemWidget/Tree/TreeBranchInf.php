<?php
namespace Tree;

use Closure;

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

    /**
     * @author ShiO
     * @param $removeFun
     * @return mixed
     */
    public function remove(Closure $removeFun = null);

    /**
     * @author ShiO
     * @param $data
     * @param Closure $saveFun
     * @return mixed
     */
    public function save($data, Closure $saveFun = null);

    /**
     * @author ShiO
     * @param Closure $eachFun
     * @return mixed
     */
    public function each(Closure $eachFun);

    /**
     * @author ShiO
     * @param Closure $selectorFun
     * @return mixed
     */
    public function findChildBySelector(Closure $selectorFun);

    /**
     * @author ShiO
     * @param Closure $selectorFun
     * @return mixed
     */
    public function findBySelector(Closure $selectorFun);

    /**
     * @author ShiO
     * @param TreeInf $tree
     * @return mixed
     */
    public function setParent(TreeInf $tree);

    /**
     * @author ShiO
     * @return TreeInf
     */
    public function getParent();
}