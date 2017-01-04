<?php
namespace Tree;

use Closure;

/**
 * @class TreeBranch
 * @author ShiO
 */
class TreeBranch implements TreeBranchInf {
    public $childs = array();
    public $parent = null;
    public $data = array();

    /**
     * @author ShiO
     * TreeBranch constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * @author ShiO
     * @param TreeInf $tree
     * @return mixed
     */
    public function addChild(TreeInf $tree) {
        $this->childs[] = $tree;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getChilds() {
        return $this->childs;
    }

    /**
     * @author ShiO
     * @param string $child
     * @return mixed
     */
    public function toArray($child = '_child') {
        $temp = array();
        $data = $this->data;
        if ($this->childs) {
            foreach ($this->childs as $item) {
                $temp[] = $item->toArray($child);
            }
            $data[$child] = $temp;
        }
        return $data;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @author ShiO
     * @param $removeFun
     * @return mixed|void
     */
    public function remove(Closure $removeFun = null) {
        // 先处理再删除，删了就没了
        if ($removeFun) {
            call_user_func($removeFun, $this);
        }
        $this->data = null;
        // 删除元素是不用触发子对象的，但是需要针对元素进行删库处理，所以此处循环触发子方法
        if ($this->childs) {
            foreach ($this->childs as $item) {
                $item->remove($removeFun);
            }
        }
        if ($this->parent) {
            // 去父对象中找自己，把自己清除掉
            $key = array_search($this, $this->parent->childs);
            unset($this->parent->childs[$key]);
        }
    }

    /**
     * @author ShiO
     * @param $data
     * @param Closure $saveFun
     * @return mixed|void
     */
    public function save($data, Closure $saveFun = null) {
        $this->data = $data;
        if ($saveFun) {
            call_user_func($saveFun, $this);
        }
    }

    /**
     * @author ShiO
     * @param Closure $eachFun
     * @return mixed
     */
    public function each(Closure $eachFun) {
        foreach ($this->childs as $item) {
            call_user_func($eachFun, $item);
        }
    }

    /**
     * @author ShiO
     * @param Closure $selectorFun
     * @return TreeBranch
     */
    public function findChildBySelector(Closure $selectorFun) {
        foreach ($this->childs as $item) {
            $flag = call_user_func($selectorFun, $item);
            if ($flag) {
                return $item;
            }
        }
        return false;
    }

    /**
     * @author ShiO
     * @param Closure $selectorFun
     * @return $this
     */
    public function findBySelector(Closure $selectorFun) {
        // 查看自己符不符合规则
        $flag = call_user_func($selectorFun, $this);
        if ($flag) {
            return $this;
        }

        // 查询子节点
        if ($this->childs) {
            // 有子节点
            foreach ($this->childs as $item) {
                $obj = $item->findBySelector($selectorFun);
                if ($obj instanceof TreeBranch) {
                    return $obj;
                }
            }
        }
        return false;
    }

    /**
     * @author ShiO
     * @param TreeInf $tree
     * @return mixed
     */
    public function setParent(TreeInf $tree) {
        $this->parent = $tree;
    }

    /**
     * @author ShiO
     * @return TreeInf
     */
    public function getParent() {
        return $this->parent;
    }
}