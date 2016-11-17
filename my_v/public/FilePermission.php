<?php

/**
 * @class FilePermission
 * @author ShiO
 */
class FilePermission {
    const FileRead = 501;
    const FileWrite = 502;
    const FileDel = 502;
    private $authorizationArr = array(
        FilePermission::FileRead,
        FilePermission::FileWrite,
    );


    /**
     * @author ShiO
     * @param $permissionNum
     * @return bool
     * @throws Exception
     */
    public function need($permissionNum) {
        if ($this->have($permissionNum)) {
            return true;
        } else {
            // TODO::索求权限
            $result = false;
            if (!$result) {
                throw new Exception('缺失权限'.$permissionNum);
            } else {
                true;
            }
        }
    }

    /**
     * @author ShiO
     * @param $permissionNum
     * @return bool
     */
    private function have($permissionNum) {
        return in_array($permissionNum, $this->authorizationArr);
    }

    /**
     * @author ShiO
     * @param $permissionNum
     * @return mixed
     */
    public function check($permissionNum) {
        if ($this->have($permissionNum)) {
            return true;
        }
    }
}
