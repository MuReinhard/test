<?php
namespace Tree;
/**
 * @class TreeManage
 * @author ShiO
 */
class TreeManage {
    /**
     * @author ShiO
     * @param $data
     * @return TreeBranch
     */
    public function crate($data) {
        // 标准树结构数组解析
        $pk = 'id';
        $pid = 'pid';
        $root = 0;
        $obj = $this->analysisList($data, $pk, $pid, $root);
        return $obj;
    }

    /**
     * @author ShiO
     * @param $data
     * @param string $pk
     * @param string $pPk
     * @param int $root
     */
    private function analysisList($data, $pk = 'id', $pPk = 'pid', $root = 0) {
        $rootArr = array_filter($data, function ($arr) use ($root, $pPk) {
            if ($arr[$pPk] == $root) {
                return true;
            } else {
                return false;
            }
        });
        $rootPk = $rootArr[0][$pk];

        $allObjArr = array();
        foreach ($data as $arr) {
            $allObjArr[$arr[$pk]] = new TreeBranch($arr);
        }

        foreach ($data as $arr) {
            if ($arr[$pk] != $rootPk) {
                $pId = $arr[$pPk];
                $id = $arr[$pk];
                $parentObj = $allObjArr[$pId];
                $childObj = $allObjArr[$id];
                $childObj->setParent($parentObj);
                $parentObj->addChild($childObj);
            }
        }
        return $allObjArr[$rootPk];
    }


    /**
     * @author ShiO
     * @param $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int $root
     * @return array
     */
    function listToTree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] =& $list[$key];
            }
            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] =& $list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent =& $refer[$parentId];
                        $parent[$child][] =& $list[$key];
                    }
                }
            }
        }
        return $tree;
    }

    /**
     * @author ShiO
     * @param $arr2D
     * @param $sortKey
     * @param int $sortType
     * @return array|bool
     */
    public function sort2DArrByKey($arr2D, $sortKey, $sortType = SORT_ASC) {
        if (is_array($arr2D)) {
            foreach ($arr2D as $row_array) {
                if (is_array($row_array)) {
                    $key_array[] = $row_array[$sortKey];
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
        array_multisort($key_array, $sortType, $arr2D);
        return $arr2D;
    }


    /**
     * @author ShiO
     * @param $childData
     * @param $parentData
     * @param $parentPk
     * @return array
     */
    public function crateChildAndPrent($childData, $parentData, $parentPk) {
        $parentData = $this->arrayGroupByKey($parentData, $parentPk);
        $crateArr = array();
        foreach ($childData as $child) {
            $parentId = $child[$parentPk];
            if (isset($crateArr[$parentId])) {
                // 对象已经存储
                $parentObj = $crateArr[$parentId];
            } else {
                // 对象尚未存储
                $parent = $parentData[$parentId];
                $parentObj = new TreeBranch($parent[0]);
                $crateArr[$parentId] = $parentObj;
            }
            $childObj = new TreeBranch($child);
            $childObj->setParent($parentObj);
            $parentObj->addChild($childObj);
            $crateArr[$parentId] = $parentObj;
        }
        return $crateArr;
    }

    /**
     * @author ShiO
     * @param $arr
     * @param $groupKey
     * @param bool $ifKeepIndexTo3D
     * @return array
     */
    public function arrayGroupByKey($arr, $groupKey, $ifKeepIndexTo3D = false) {
        $return = array();
        foreach ($arr as $key => $value) {
            if ($ifKeepIndexTo3D) {
                $return[][$value[$groupKey]][] = $value;
            } else {
                $return[$value[$groupKey]][] = $value;
            }
        }
        return $return;
    }
}