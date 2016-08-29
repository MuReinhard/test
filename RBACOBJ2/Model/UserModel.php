<?php
namespace Model;
use ModelInf\ModelInf;
use RbacModelInf\RbacRoleModelInf;
use RbacModelInf\RbacUserModelInf;

/**
 * @class UserModel
 * @author ShiO
 */
class UserModel extends Model implements ModelInf, RbacUserModelInf {
    /**
     * @author ShiO
     * UserModel constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    public $user_id;
    public $user_name;

    /**
     * @author ShiO
     * 绑定角色
     * @param RbacRoleModelInf $roleModel
     * @return mixed
     */
    public function bindRole(RbacRoleModelInf $roleModel) {
        $relationModel = new UserRoleRelationModelModel();
        $relationModel->connect($this, $roleModel);
        $relationModel->addData();
    }

    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'u_user' => 'u_user',
        );
        $data = array(
            'user_name' => $this->user_name,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('user_id', $id);
        return $this;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPk() {
        return $this->user_id;
    }

    /**
     * @author ShiO
     * @param $id
     * @return $this
     */
    public function findData($id) {
        $table = array(
            'u_user' => 'u_user',
        );
        $where = 'user_id' . '=' . $id;
        $data = $this->table($table)->field()->where($where)->select();
        $this->modelBean($data);
        return $this;
    }
}