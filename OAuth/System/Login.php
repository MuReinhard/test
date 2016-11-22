<?php

/**
 * @class Login
 * @author ShiO
 */
class Login {
    public $loginStatus;
    public $userName;
    public $userId;

    /**
     * @author ShiO
     * @return mixed
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @author ShiO
     * @param mixed $userId
     */
    public function setUserId($userId) {
        $this->userId = $userId;
    }


    /**
     * @author ShiO
     * Login constructor.
     */
    public function __construct() {
        // 默认登陆状态为假
        $this->loginStatus = false;
    }

    /**
     * @author ShiO
     * @return boolean
     */
    public function isLoginStatus() {
        return $this->loginStatus;
    }

    /**
     * @author ShiO
     * @param boolean $loginStatus
     */
    public function setLoginStatus($loginStatus) {
        $this->loginStatus = $loginStatus;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getUserName() {
        return $this->userName;
    }

    /**
     * @author ShiO
     * @param mixed $userName
     */
    public function setUserName($userName) {
        $this->userName = $userName;
    }
}