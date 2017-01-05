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
        $rootArr = array();
        foreach ($data as $arr) {
            if ($root == 0) {
                $find = $pPk;
            } else {
                $find = $pk;
            }
            if ($arr[$find] == $root) {
                $rootArr = $arr;
                break;
            }
        }
        $rootPk = $rootArr[$pk];

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