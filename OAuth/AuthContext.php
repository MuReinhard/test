<?php

/**
 * @class ContextManage
 * @author ShiO
 */
class AuthContext  {

    /**
     * @author ShiO
     * ContextManage constructor.
     * @param Request $request
     * @param Config $config
     * @param Login $login
     * @param Application $application
     * @param RequestCodeStorageInf $requestCodeStorage
     * @return Context
     */
    public function init(Request $request, Config $config, Login $login, Application $application, RequestCodeStorageInf $requestCodeStorage) {
        $context = new Context();
        $context->setLogin($login);
        $context->setApplication($application);
        $context->setConfig($config);
        $context->setRequestCodeStorage($requestCodeStorage);
        return $context;
    }
}