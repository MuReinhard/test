<?php
namespace Model;
use ModelInf\RelationModelInf;
use RbacModelInf\RbacUserModelInf;

/**
 * @class UserGroupRelationModel
 * @author ShiO
 */
class UserGroupRelationModel extends Model implements RelationModelInf {
    public $u_u_g_relation_id;
    public $user_id;
    public $user_group_id;

    /**
     * @author ShiO
     * 绑定组成员对象
     * @param UserModel $userModel
     * @param UserModelGroupModel $userGroupModel
     * @return $this
     */
    public function connect($userModel, $userGroupModel) {
        // 类类型验证
        if ($userModel instanceof RbacUserModelInf && $userGroupModel instanceof RbacUserModelInf) {
            $this->user_id = $userModel->getPk();
            $this->user_group_id = $userGroupModel->getPk();
            $this->addData();
        }
        return $this;
    }

    /**
     * @author ShiO
     */
    public function addData() {
        $table = array(
            'user_group_relation' => 'user_group_relation',
        );
        $data = array(
            'user_id' => $this->user_id,
            'user_group_id' => $this->user_group_id,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('u_u_g_relation_id', $id);
        return $this;
    }

}