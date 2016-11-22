<?php

/**
 * @class SilentAuth
 * @author ShiO
 */
class SilentAuth extends Auth{

    /**
     * @author ShiO
     * @param Request $request
     * @param Context $context
     */
    public function auth(Request $request, Context $context) {
        $creator = $context->getAuthCreator();
        $creator->data($request);
        $creator->add();
        $code = $creator->getCode();
        $this->reUrl($request,$code);
    }
}