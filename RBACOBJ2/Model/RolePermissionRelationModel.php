<?php
namespace Model;
/**
 * @class RbacRolePermissionModel
 * @author ShiO
 */
class RbacRolePermissionRelationModel  extends Model implements RelationInf{
    public $relationType = self::RELATION_TYPE_MANY_TO_MANY;

    /**
     * @author ShiO
     * 绑定组成员对象
     * @param $groupModel
     * @param $bindModel
     * @return mixed
     */
    public function connect($groupModel, $bindModel) {
        // TODO: Implement bind() method.
    }
}