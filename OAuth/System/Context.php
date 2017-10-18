<?php

/**
 * @class Context
 * @author ShiO
 */
class Context {
    private $config;
    private $requestCodeStorage;
    private $login;
    private $application;

    /**
     * @author ShiO
     * @return Login
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * @author ShiO
     * @param mixed $login
     */
    public function setLogin($login) {
        $this->login = $login;
    }

    /**
     * @author ShiO
     * @return Application
     */
    public function getApplication() {
        return $this->application;
    }

    /**
     * @author ShiO
     * @param mixed $application
     */
    public function setApplication($application) {
        $this->application = $application;
    }

    /**
     * @author ShiO
     * @return Config
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * @author ShiO
     * @param mixed $config
     */
    public function setConfig($config) {
        $this->config = $config;
    }

    /**
     * @author ShiO
     * @return RequestCodeStorageInf
     */
    public function getRequestCodeStorage() {
        return $this->requestCodeStorage;
    }

    /**
     * @author ShiO
     * @param RequestCodeStorageInf $requestCodeStorage
     */
    public function setRequestCodeStorage(RequestCodeStorageInf $requestCodeStorage) {
        $this->requestCodeStorage = $requestCodeStorage;
    }

}