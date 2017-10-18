<?php

/**
 * 改变数据格式工具类
 * Class DataFormatTool
 * 工具函数：
 * list_to_tree 数据集转换成Tree
 */
class DataFormatTool {
    /**
     * +----------------------------------------------------------
     * 把返回的数据集转换成Tree
     * +----------------------------------------------------------
     * @access public
     * +----------------------------------------------------------
     * @param array $list 要转换的数据集
     * @param string $pk 主键
     * @param string $pid 父id标记字段
     * @param string $child 生成字段
     * @param int $root 被转换数据集中，作为根节点的id
     * +----------------------------------------------------------
     * 需求格式：
     * array[0]=>['@param $pk '] = 1
     *        =>['@param $pid '] = 0
     *        =>['data'] = data_p1
     * array[1]=>['@param $pk '] = 2
     *        =>['@param $pid '] = 1
     *        =>['data'] = data_p1_c1
     * array[2]=>['@param $pk '] = 3
     *        =>['@param $pid '] = 2
     *        =>['data'] = data_p1_c1_cc1
     * +----------------------------------------------------------
     * @return array
    +----------------------------------------------------------
     */
    static function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0) {
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
     * 递归方式生成
     * @param $data
     * @param $pid
     * @param $pidKey
     * @param $idKey
     * @param $childKey
     * @return array
     */
    static public function recursionArrToTree($data, $pid, $pidKey, $idKey, $childKey) {
        $tree = array();                                //每次都声明一个新数组用来放子元素
        foreach ($data as $v) {
            if ($v[$pidKey] == $pid) {                      //匹配子记录
                $v[$childKey] = self::recursionArrToTree($data, $v[$idKey], $pidKey, $idKey, $childKey); //递归获取子记录
                if ($v[$childKey] == null) {
                    unset($v[$childKey]);             //如果子元素为空则unset()进行删除，说明已经到该分支的最后一个元素了（可选）
                }
                $tree[] = $v;                           //将记录存入新数组
            }
        }
        return $tree;                                  //返回新数组
    }

}