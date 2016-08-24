<?php
namespace Model;
/**
 * @class UserGroupRelationModel
 * @author ShiO
 */
class UserGroupRelationModel extends Model implements RelationInf {
    private $user_id = null;
    private $user_group_id = null;

    /**
     * @author ShiO
     * 绑定组成员对象
     * @param $userModel
     * @param $userGroupModel
     * @return $this
     */
    public function connect($userModel, $userGroupModel) {
        // 类类型验证
        if ($userModel instanceof RbacUserInf && $userGroupModel instanceof RbacUserInf && $userGroupModel instanceof GroupModelInf) {
            $this->user_id = $userModel->getPk();
            $this->user_group_id = $userGroupModel->getPk();
        }
        return $this;
    }
}