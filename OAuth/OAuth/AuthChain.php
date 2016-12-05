<?php

/**
 * @class Auth
 * @author ShiO
 */
abstract class AuthChain {
    protected $next;

    /**
     * @author ShiO
     * @param Request $request
     * @param Context $context
     */
    abstract public function auth(Request $request, Context $context);

    /**
     * @author ShiO
     * @param AuthChain $next
     */
    public function setHandle(AuthChain $next) {
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