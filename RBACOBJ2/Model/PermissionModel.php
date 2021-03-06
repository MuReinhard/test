<?php
namespace Model;

use RbacModelInf\RbacPermissionModelInf;
use RbacModelInf\RbacRoleModelInf;

/**
 * 角色与用户视图
 * @author ShiO
 * @date 2015年9月19日21:50:04
 */
class PermissionModel extends Model implements RbacPermissionModelInf {
    public $permission_id;
    public $permission_name;
    /**
     * @author ShiO
     * RoleModel constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @author ShiO
     * 绑定角色
     * @param RbacRoleModelInf | RoleModel $roleModel
     * @return mixed
     */
    public function bindRole(RbacRoleModelInf $roleModel) {
        $relation = new PermissionRoleRelationModel();
        $relation->connect($this, $roleModel);
        $relation->addData();
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPk() {
        return $this->permission_id;
    }

    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'permission' => 'permission',
        );
        $data = array(
            'permission_name' => $this->permission_name,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('permission_id', $id);
        return $this;
    }
}

?>