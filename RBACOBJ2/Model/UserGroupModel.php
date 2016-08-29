<?php
namespace Model;

use ModelInf\GroupModelInf;
use RbacModelInf\RbacRoleModelInf;
use RbacModelInf\RbacUserModelInf;

/**
 * @class UserGroupModel
 * @author ShiO
 */
class UserModelGroupModel extends Model implements RbacUserModelInf, GroupModelInf {
    public $user_group_id;
    public $user_group_name;

    /**
     * @author ShiO
     * UserModel constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @author ShiO
     * 绑定角色
     * @param RbacRoleModelInf|RoleModel $roleModel
     * @return mixed
     */
    public function bindRole(RbacRoleModelInf $roleModel) {
        $relation = new UserGroupRoleRelationModel();
        $relation->connect($this, $roleModel);
        $relation->addData();
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPk() {
        return $this->user_group_id;
    }

    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'user_group' => 'user_group',
        );
        $data = array(
            'user_group_name' => $this->user_group_name,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('user_group_id', $id);
        return $this;
    }
}