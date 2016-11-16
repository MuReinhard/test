<?php
namespace Model;
use ModelInf\GroupModelInf;
use ModelInf\ModelInf;
use RbacModelInf\RbacPermissionModelInf;
use RbacModelInf\RbacRoleModelInf;
use RbacModelInf\RbacUserModelInf;

/**
 * @class RoleModel
 * @author ShiO
 */
class RoleModel extends Model implements ModelInf, RbacRoleModelInf {
    /**
     * @author ShiO
     * RoleModel constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    public $role_id;
    public $role_name;

    /**
     * @author ShiO
     * 绑定权限
     * @param $permission
     * @return mixed
     */
    public function bindPermission(RbacPermissionModelInf $permission) {
        if ($permission instanceof GroupModelInf) {
            // 权限组model
            $permission->bindRole($this);
        } else {
            // 权限model
            $permission->bindRole($this);
        }
    }

    /**
     * @author ShiO
     * @param RbacUserModelInf $model
     * @return mixed
     */
    public function bindUserTarget(RbacUserModelInf $model) {
        if ($model instanceof GroupModelInf) {
            // 用户组model
            $model->bindRole($this);
        } else {
            // 用户model
            $model->bindRole($this);
        }
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPk() {
        return $this->role_id;
    }

    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'role' => 'role',
        );
        $data = array(
            'role_name' => $this->role_name,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('role_id', $id);
        return $this;
    }

    /**
     * @author ShiO
     * @param $id
     * @return $this
     */
    public function findData($id) {
        $table = array(
            'role' => 'role',
        );
        $where = 'role_id' . '=' . $id;
        $data = $this->table($table)->field()->where($where)->select();
        $this->modelBean($data[0]);
        return $this;
    }
}