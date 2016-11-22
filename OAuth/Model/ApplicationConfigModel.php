<?php

/**
 * @class ApplicationConfig
 * @author ShiO
 */
class ApplicationConfigModel {
    public $loginUrl;
    public $loginType;
    const LOGIN_TYPE_CENTER = 1;
    const LOGIN_TYPE_APP = 2;

    /**
     * @author ShiO
     * ApplicationConfigModel constructor.
     */
    public function __construct() {
        // TODO::暂时使用
        $this->loginType = self::LOGIN_TYPE_CENTER;
        $this->loginUrl = 'http://baidu.com';
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getLoginUrl() {
        return $this->loginUrl;
    }

    /**
     * @author ShiO
     * @return int
     */
    public function getLoginType() {
        return $this->loginType;
    }
}