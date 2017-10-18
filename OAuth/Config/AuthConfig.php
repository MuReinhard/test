<?php

/**
 * @class AuthConfig
 * @author ShiO
 */
class AuthConfig {
    public $centerLoginUrl;
    const SNSAPI_BASE = 'snsapi_base';
    const SNSAPI_USERINFO = 'snsapi_userinfo';

    /**
     * @author ShiO
     * @return mixed
     */
    public function getCenterLoginUrl() {
        return $this->centerLoginUrl;
    }

}