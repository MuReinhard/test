<?php

/**
 * @class Permission
 * @author ShiO
 */
class Permission {
    private $permissionArr = array();

    /**
     * @author ShiO
     * @param Permission $permission
     * @return bool
     */
    public function match(Permission $permission) {
        // 比对权限是否存在

        return true;
    }

    /**
     * @author ShiO
     * @return array
     */
    public function getPermissionArr() {
        return $this->permissionArr;
    }

    /**
     * @author ShiO
     * @param array $permissionArr
     */
    public function setPermissionArr($permissionArr) {
        $this->permissionArr = $permissionArr;
    }
}