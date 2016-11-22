<?php

/**
 * @class Context
 * @author ShiO
 */
class Context {
    private $config;
    private $authCreator;



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
     * @return AuthCreator
     */
    public function getAuthCreator() {
        return $this->authCreator;
    }

}