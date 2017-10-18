<?php

/**
 * @class Auth
 * @author ShiO
 */
class Auth {
    /**
     * @author ShiO
     * Auth constructor.
     * @param Request $request
     * @param Context $context
     */
    public function auth(Request $request, Context $context) {
        $login = $context->getLogin();
        if ($login->isLoginStatus()) {
            // 如果已经登录，开始验证信息
            $authConfig = $context->getConfig()->getAuth();
            $permission = new PermissionAuth();
            // 根据请求切换不同的处理策略
            switch ($request->getGet()['scope']) {
                case $authConfig::SNSAPI_BASE:
                    $permission->setHandle(new SilentAuth());
                    break;
                case $authConfig::SNSAPI_USERINFO:
                    $permission->setHandle(new WebAuth());
                    break;
            }
            // 启动处理策略
            $permission->auth($request, $context);
        } else {
            $authConfig = $context->getConfig()->getAuth();
            // 进入登录解析流程
            $application = $context->getApplication();
            $appConfig = $application->getAppConfig();
            switch ($appConfig->getLoginType()) {
                case ApplicationConfigModel::LOGIN_TYPE_APP:
                    http_redirect($appConfig->getLoginUrl());
                    break;
                case ApplicationConfigModel::LOGIN_TYPE_CENTER:
                    // 使用用户中心设置的网页
                    http_redirect($authConfig->getCenterLoginUrl());
                    break;
            }
        }
    }

}