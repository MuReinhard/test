<?php
namespace Model;
use ModelInf\GroupModelInf;
use RbacModelInf\RbacPermissionModelInf;
use RbacModelInf\RbacRoleModelInf;

/**
 * @class PermissionGroupModel
 * @author ShiO
 */
class RbacPermissionGroupModel extends Model implements RbacPermissionModelInf, GroupModelInf {
    public $permission_group_id;
    public $permission_group_name;


    /**
     * @author ShiO
     * 绑定角色
     * @param RbacRoleModelInf|RoleModel $roleModel
     * @return mixed
     */
    public function bindRole(RbacRoleModelInf $roleModel) {
        $relation = new PermisionGroupRoleRelationModelModel();
        $relation->connect($this, $roleModel);
    }

    /**
     * @author ShiO
     */
    public function getPk() {
        return $this->permission_group_id;
    }

    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'permission_group' => 'permission_group',
        );
        $data = array(
            'permission_group_name' => $this->permission_group_name,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('permission_group_id', $id);
        return $this;
    }
}