<?php
namespace Model;
use ModelInf\ModelInf;
use ModelInf\RelationModelInf;
use RbacModelInf\RbacRoleModelInf;
use RbacModelInf\RbacUserModelInf;

/**
 * @class UserRoleRelation
 * @author ShiO
 */
class UserRoleRelationModelModel extends Model implements ModelInf, RelationModelInf {
    public $u_r_relation_id;
    public $user_id;
    public $role_id;


    /**
     * @author ShiO
     * 绑定组成员对象
     * @param UserModelModel $userModel
     * @param RbacRoleModelInf|RoleModel $roleModel
     * @return mixed
     */
    public function connect($userModel, $roleModel) {
        if ($userModel instanceof RbacUserModelInf && $roleModel instanceof RbacRoleModelInf) {
            $this->user_id = $userModel->getPk();
            $this->role_id = $roleModel->getPk();
            $this->addData();
        }
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPk() {
        return $this->u_r_relation_id;
    }

    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'user_role_relation' => 'user_role_relation',
        );
        $data = array(
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('u_r_relation_id', $id);
        return $this;
    }
}