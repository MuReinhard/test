<?php
namespace RbacModelInf;
/**
 * @class RbacUserInf
 * @author ShiO
 */
interface RbacUserModelInf {

    /**
     * @author ShiO
     * 绑定角色
     * @param RbacRoleModelInf $roleModel
     * @return mixed
     */
    public function bindRole(RbacRoleModelInf $roleModel);

    /**
     * @author ShiO
     * @param $userId
     * @return mixed
     */
    public function getUserAllRole($userId);

}