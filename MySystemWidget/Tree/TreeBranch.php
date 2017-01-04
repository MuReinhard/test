<?php
namespace Tree;

use Closure;

/**
 * @class TreeBranch
 * @author ShiO
 */
class TreeBranch implements TreeBranchInf {
    public $childs = array();
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
        // 所有元素
        $this->data = null;
        if ($this->childs) {
            foreach ($this->childs as $item) {
                $item->remove($removeFun);
                // 把子对象也清理干净
                $key = array_search($item, $this->childs);
                unset($this->childs[$key]);
            }
        }
        if ($removeFun) {
            call_user_func($removeFun, $this);
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
}