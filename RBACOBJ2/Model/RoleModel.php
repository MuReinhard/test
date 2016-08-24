<?php
namespace Model;
/**
 * @class RoleModel
 * @author ShiO
 */
class RbacRoleModel extends Model implements RoleModelInf {

    /**
     * @author ShiO
     * 得到所有权限
     * @return mixed
     */
    public function getAllPermission() {
        // TODO: Implement getAllPermission() method.
    }

    /**
     * @author ShiO
     * 得到角色下所有用户
     * @return mixed
     */
    public function getAllUser() {
        // TODO: Implement getAllUser() method.
    }

    /**
     * @author ShiO
     * 保存权限(数据库操作)
     * @param $permission
     * @return mixed
     */
    public function savePermission($permission) {
        // TODO: Implement savePermission() method.
    }

    /**
     * @author ShiO
     * 绑定权限
     * @param $permission
     * @return mixed
     */
    public function bindPermission($permission) {
        // TODO: Implement bindPermission() method.
    }

    /**
     * @author ShiO
     * 取消绑定权限
     * @param $permission
     * @return mixed
     */
    public function unBindPermission($permission) {
        // TODO: Implement unBindPermission() method.
    }
}