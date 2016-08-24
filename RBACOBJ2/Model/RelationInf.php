<?php
namespace Model;
/**
 * @class RelationInf
 * @author ShiO
 */
interface RelationInf {
    /**
     * @author ShiO
     * 绑定组成员对象
     * @param $groupModel
     * @param $bindModel
     * @return mixed
     */
    public function connect($groupModel, $bindModel);
}