<?php

/**
 * @class Application
 * @author ShiO
 */
class Application {
    public $permission;
    public $appId;

    /**
     * @author ShiO
     * @return Permission
     */
    public function getPermission() {
        return $this->permission;
    }

    /**
     * @author ShiO
     * @return ApplicationConfigModel
     */
    public function getAppConfig() {
        return $appConifg = new ApplicationConfigModel();
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getAppId() {
        return $this->appId;
    }

    /**
     * @author ShiO
     * @param mixed $appId
     */
    public function setAppId($appId) {
        $this->appId = $appId;
    }
}