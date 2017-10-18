<?php
namespace Model;
/**
 * @class RoleModelInf
 * @author ShiO
 */
interface RBACRoleModelInf {
    /**
     * @author ShiO
     * 绑定权限
     * @param $permission
     * @return mixed
     */
    public function bindPermission(PermissionModelInf $permission);

    /**
     * @author ShiO
     * @param RbacUserModelInf $model
     * @return mixed
     */
    public function bindUserTarget(RbacUserModelInf $model);
}