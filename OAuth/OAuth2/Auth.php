<?php

/**
 * @class Auth
 * @author ShiO
 */
abstract class Auth {
    protected $login;
    protected $application;
    protected $next;

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
    abstract public function auth(Request $request, Context $context);

    /**
     * @author ShiO
     * @param Auth $next
     */
    public function setHandle(Auth $next) {
        $this->next = $next;
    }

    /**
     * @author ShiO
     * @param Request $request
     * @param $code
     * @return null
     */
    protected function reUrl(Request $request,$code) {
        $url = null;
        return $url;
    }
}