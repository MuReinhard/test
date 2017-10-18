<?php
namespace ModelInf;
/**
 * @class RelationInf
 * @author ShiO
 */
interface RelationModelInf {
    /**
     * @author ShiO
     * 绑定关系
     * @param $model
     * @param $bindModel
     * @return mixed
     */
    public function connect($model, $bindModel);
}