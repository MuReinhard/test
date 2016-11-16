<?php
namespace Model;

use ModelInf\RelationModelInf;
use RbacModelInf\RbacPermissionModelInf;
use RbacModelInf\RbacRoleModelInf;

/**
 * @class RbacRolePermissionModel
 * @author ShiO
 */
class PermissionRoleRelationModel extends Model implements RelationModelInf {
    public $p_r_relation_id;
    public $permission_id;
    public $role_id;



    /**
     * @author ShiO
     * 绑定组成员对象
     * @param PermissionModel $permissionModel
     * @param RoleModel $roleModel
     * @return mixed
     */
    public function connect($permissionModel, $roleModel) {
        if ($permissionModel instanceof RbacPermissionModelInf && $roleModel instanceof RbacRoleModelInf) {
            $this->permission_id = $permissionModel->getPk();
            $this->role_id = $roleModel->getPk();
            return $this;
        }
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPk() {
        return $this->p_r_relation_id;
    }

    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'permission_role_relation' => 'permission_role_relation',
        );
        $data = array(
            'permission_id' => $this->permission_id,
            'role_id' => $this->role_id,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('p_r_relation_id', $id);
        return $this;
    }
}