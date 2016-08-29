<?php
namespace Model;

use ModelInf\RelationModelInf;
use RbacModelInf\RbacPermissionModelInf;
use RbacModelInf\RbacRoleModelInf;

/**
 * @class PermisionGroupRoleRelationModel
 * @author ShiO
 */
class PermisionGroupRoleRelationModel extends Model implements RelationModelInf {
    public $p_g_r_relation_id;
    public $permission_group_id;
    public $role_id;

    public function __construct() {
        parent::__construct();
    }

    /**
     * @author ShiO
     * 绑定组成员对象
     * @param RbacPermissionGroupModel $model
     * @param RoleModel $bindModel
     * @return mixed
     */
    public function connect($model, $bindModel) {
        if ($model instanceof RbacPermissionModelInf && $bindModel instanceof RbacRoleModelInf) {
            $this->permission_group_id = $model->getPk();
            $this->role_id = $bindModel->getPk();
            return $this;
        }
    }

    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'permision_group_role_relation' => 'permision_group_role_relation',
        );
        $data = array(
            'permission_group_id' => $this->permission_group_id,
            'role_id' => $this->role_id,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('p_g_r_relation_id', $id);
        return $this;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPk() {
        return $this->p_g_r_relation_id;
    }
}