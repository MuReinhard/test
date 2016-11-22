<?php

/**
 * @class AuthSecret
 * @author ShiO
 */
class AuthCodeSocket {
    public $login;
    public $application;

    /**
     * @author ShiO
     * AuthSecret constructor.
     * @param Login $login
     * @param Application $application
     */
    public function __construct(Login $login, Application $application) {
        $this->login = $login;
        $this->application = $application;
    }

    /**
     * @author ShiO
     * @param RequestCodeStorageInf $model
     * @return string
     */
    public function requestCodeCreate(RequestCodeStorageInf $model) {
        $model->create();
    }
}