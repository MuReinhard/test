<?php
/**
 * @author ShiO
 */
include_once 'TreeInf.php';
include_once 'TreeBranchInf.php';
include_once 'TreeItemInf.php';
include_once 'TreeItem.php';

$root = new \MySystemWidget\Tree\TreeBranch('大根');
$b1 = new \MySystemWidget\Tree\TreeBranch('分支1');
$b2 = new \MySystemWidget\Tree\TreeBranch('分支2');

$b11 = new \MySystemWidget\Tree\TreeBranch('分支1-1');
$b12 = new \MySystemWidget\Tree\TreeBranch('分支1-2');

$i111 = new \MySystemWidget\Tree\TreeItem('节点1-1-1');
$i112 = new \MySystemWidget\Tree\TreeItem('节点1-1-2');
$i113 = new \MySystemWidget\Tree\TreeItem('节点1-1-3');

$root->add($b1);
$root->add($b2);

$b1->add($b11);
$b1->add($b12);

$b11->add($i111);
$b11->add($i112);
$b11->add($i113);

/**
 * @author ShiO
 * @param $root
 */
function getTreeBean($root) {
    $result = array();
    foreach ($root as $item) {
        if ($item instanceof \MySystemWidget\Tree\TreeItemInf) {
            // 如果是最终节点 得到节点存储的信息
            $data = $item->getBean();
            $result[] = $data;
        } elseif ($item instanceof \MySystemWidget\Tree\TreeBranchInf) {
            // 如果是父节点，需要继续解析父节点下的东西
            getTreeBean($item);
        }
    }
}
