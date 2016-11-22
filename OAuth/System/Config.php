<?php

/**
 * @class Config
 * @author ShiO
 */
class Config {
    public $permission;
    public $auth;

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPermission() {
        return $this->permission;
    }

    /**
     * @author ShiO
     * @param mixed $permission
     */
    public function setPermission($permission) {
        $this->permission = $permission;
    }

    /**
     * @author ShiO
     * @return AuthConfig
     */
    public function getAuth() {
        return $this->auth;
    }
}