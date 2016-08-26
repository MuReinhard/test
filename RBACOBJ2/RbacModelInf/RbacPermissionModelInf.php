<?php
namespace RbacModelInf;
/**
 * @class PermissionModelInf
 * @author ShiO
 */
interface RbacPermissionModelInf {
    /**
     * @author ShiO
     * 绑定角色
     * @param RbacRoleModelInf $roleModel
     * @return mixed
     */
    public function bindRole(RbacRoleModelInf $roleModel);

}