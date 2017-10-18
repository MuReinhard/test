<?php
namespace RbacModelInf;
/**
 * @class RoleModelInf
 * @author ShiO
 */
interface RbacRoleModelInf {
    /**
     * @author ShiO
     * 绑定权限
     * @param $permission
     * @return mixed
     */
    public function bindPermission(RbacPermissionModelInf $permission);

    /**
     * @author ShiO
     * @param RbacUserModelInf $model
     * @return mixed
     */
    public function bindUserTarget(RbacUserModelInf $model);
}