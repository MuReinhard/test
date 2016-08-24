<?php
namespace Model;
/**
 * @class RoleModelInf
 * @author ShiO
 */
interface RoleModelInf {
    /**
     * @author ShiO
     * 得到所有权限
     * @return mixed
     */
    public function getAllPermission();

    /**
     * @author ShiO
     * 得到角色下所有用户
     * @return mixed
     */
    public function getAllUser();

    /**
     * @author ShiO
     * 保存权限(数据库操作)
     * @param $permission
     * @return mixed
     */
    public function savePermission($permission);

    /**
     * @author ShiO
     * 绑定权限
     * @param $permission
     * @return mixed
     */
    public function bindPermission($permission);

    /**
     * @author ShiO
     * 取消绑定权限
     * @param $permission
     * @return mixed
     */
    public function unBindPermission($permission);
}