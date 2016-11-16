<?php
namespace RBAC;

use RbacModelInf\RbacUserModelInf;

/**
 * @interface RbacBuilderInf
 * @author ShiO
 */
interface RbacBuilderInf {
    /**
     * @author ShiO
     * 用户所有的角色
     * @return mixed
     */
    public function userRoleToTree();

    /**
     * @author ShiO
     * 用户所有权限
     * @return mixed
     */
    public function userPermissionToTree();
}