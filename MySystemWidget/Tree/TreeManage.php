<?php
namespace Tree;

use Closure;
use Tree\Bean\OptionBean;
use Tree\Bean\QuestionBean;

/**
 * @class TreeManage
 * @author ShiO
 */
class TreeManage {
    public $tree;

    /**
     * @author ShiO
     * TreeManage constructor.
     * @param TreeBranchInf $tree
     */
    public function __construct(TreeBranchInf $tree) {
        $this->tree = $tree;
    }

    /**
     * @author ShiO
     */
    public function getTreeBean() {
        $this->treeIterator($this->tree, function ($bean) {
            dump($bean);
        });
    }

    /**
     * @author ShiO
     */
    public function getTreeItem() {
        $this->treeIterator($this->tree, function ($bean) {
            dump($bean);
        }, false);
    }

    /**
     * @author ShiO
     * @param TreeBranchInf $tree
     * @param Closure $func
     * @param bool $isGetBean
     * @param bool $isFind
     * @return array
     */
    private function treeIterator(TreeBranchInf $tree, Closure $func, $isGetBean = true, $isFind = false) {
        $treeArr = $tree->getTrees($tree);
        foreach ($treeArr as $item) {
            if ($item instanceof TreeItemInf) {
                // 如果是最终节点 得到节点存储的信息
                if ($isGetBean) {
                    $giveObj = $item->getBean();
                } else {
                    $giveObj = $item;
                }
                if ($isFind) {
                    return call_user_func($func, $giveObj);
                } else {
                    call_user_func($func, $giveObj);
                }
            } elseif ($item instanceof TreeBranchInf) {
                // 如果是父节点，需要继续解析父节点下的东西
                if ($isGetBean) {
                    $giveObj = $item->getBean();
                } else {
                    $giveObj = $item;
                }
                if ($isFind) {
                    return call_user_func($func, $giveObj);
                } else {
                    call_user_func($func, $giveObj);
                }
                $this->treeIterator($item, $func, $isGetBean);
            }
        }
    }

    /**
     * @author ShiO
     * @param $id
     * @return array
     */
    public function getQuestionById($id) {
        $branch = $this->treeIterator($this->tree, function ($branch) use ($id) {
            $bean = $branch->getBean();
            if ($bean instanceof QuestionBean && $bean->getQuestionId() == $id) {
                return $branch;
            }
        }, false, true);

        return $branch;
    }

}