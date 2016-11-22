<?php

/**
 * @class Auth
 * @author ShiO
 */
class Auth {
    private $login;
    private $application;

    /**
     * @author ShiO
     * Auth constructor.
     * @param Login $login
     * @param Application $application
     */
    public function __construct(Login $login, Application $application) {
        $this->login = $login;
        $this->application = $application;
    }

    /**
     * @author ShiO
     * @param Request $request
     * @param Context $context
     */
    public function auth(Request $request, Context $context) {
        // 得到请求的权限
        $this->checkPermission($this->application->getPermission(), $context->getConfig()->getPermission());
        if (!$this->checkLogin($this->login)) {
            $this->redirectLogin($this->application, $context);
        }
        $get = $request->getGet();

        // TODO::Model的机制需要迭代优化
        $data = array(
            'uid' => $this->login->getUserId(),
            'app_id' => $this->application->appId,
        );

        // 判断授权方式
        if ($get['scope'] == AuthConfig::SNSAPI_BASE) {
            // 静默授权
            $data['code'] = RequestCodeModel::SNSAPI_BASE;

            $model = new RequestCodeModel();
            $model->data($data);
            $secret = new AuthCodeSocket($this->login, $this->application);
            $requeseCode = $secret->requestCodeCreate($model);
            $url = $this->finalUrl($request, $requeseCode);
            http_redirect($url);
        }
        if ($get['scope'] == AuthConfig::SNSAPI_USERINFO) {
            // 网页授权
            if (!$get['agree'] == 'agree') {
                // 用户已经同意

                $data['code'] = RequestCodeModel::SNSAPI_USERINFO;
                $model = new RequestCodeModel();
                $model->data($data);
                $secret = new AuthCodeSocket($this->login, $this->application);
                $requeseCode = $secret->requestCodeCreate($model);
                $url = $this->finalUrl($request, $requeseCode);
                http_redirect($url);
            } else {
                $this->authPage($request);
            }
        }

    }

    /**
     * @author ShiO
     * @param Permission $applicationPer
     * @param Permission $configPer
     * @return bool
     * @throws
     */
    private function checkPermission(Permission $applicationPer, Permission $configPer) {
        if (!$applicationPer->match($configPer)) {
            throw new PermissionDeniedException();
        }
    }

    /**
     * @author ShiO
     * @param Login $login
     * @return bool
     */
    private function checkLogin(Login $login) {
        if (!$login->isLoginStatus()) {
            return false;
        }
    }

    /**
     * @author ShiO
     * @param Application $application
     * @param Context $context
     */
    private function redirectLogin(Application $application, Context $context) {
        switch ($application->getAppConfig()->getLoginType()) {
            // TODO::这里是否出现越权设计？犹未可知 按照日后迭代更新
            case ApplicationConfigModel::LOGIN_TYPE_APP:
                $url = $application->getAppConfig()->getLoginUrl();
                break;
            case ApplicationConfigModel::LOGIN_TYPE_CENTER:
                $url = $context->getConfig()->getAuth()->getCenterLoginUrl();
                break;
        }
        http_redirect($url);
    }

    /**
     * @author ShiO
     * @param Request $request
     * @param $requeseCode
     * @return string
     */
    private function finalUrl(Request $request, $requeseCode) {
        $url = $request->getGet()['redirect_uri'] . '/code/' . $requeseCode;
        return $url;
    }

    /**
     * @author ShiO
     * @param Request $request
     */
    private function authPage(Request $request) {
        // 用户授权页面
        $this->display('auth');
    }
}