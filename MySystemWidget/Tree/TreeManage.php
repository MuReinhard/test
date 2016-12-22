<?php
namespace MySystemWidget\Tree;

/**
 * @class TreeManage
 * @author ShiO
 */
class TreeManage {
    /**
     * @author ShiO
     * @param TreeBranchInf $root
     */
    public function getTreeBean(TreeBranchInf $root) {
        $result = array();
        foreach ($root as $item) {
            if ($item instanceof TreeItemInf) {
                // 如果是最终节点 得到节点存储的信息
                $data = $item->getBean();
                $result[] = $data;
            } elseif ($item instanceof TreeBranchInf) {
                // 如果是父节点，需要继续解析父节点下的东西
                getTreeBean($item);
            }
        }
    }

}