<?php
namespace Model;
use ModelInf\ModelInf;
use ModelInf\RelationModelInf;

/**
 * @class RoleGroupRelationModel
 * @author ShiO
 */
class UserGroupRoleRelationModel extends Model implements ModelInf,RelationModelInf {
    public $u_g_r_relation_id;
    public $user_group_id;
    public $role_id;

    /**
     * @author ShiO
     * 绑定组成员对象
     * @param UserModelGroupModel $userGroupModel
     * @param RoleModel $roleModel
     * @return mixed
     */
    public function connect($userGroupModel, $roleModel) {
        $this->user_group_id = $userGroupModel->getPk();
        $this->role_id = $roleModel->getPk();
        return $this;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPk() {
        return $this->u_g_r_relation_id;
    }
    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'user_group_role_relation' => 'user_group_role_relation',
        );
        $data = array(
            'user_group_id' => $this->user_group_id,
            'role_id' => $this->role_id,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('u_g_r_relation_id', $id);
        return $this;
    }
}