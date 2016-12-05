<?php

/**
 * @class SilentAuth
 * @author ShiO
 */
class SilentAuth extends AuthChain{

    /**
     * @author ShiO
     * @param Request $request
     * @param Context $context
     * @throws WrongClassTypeException
     */
    public function auth(Request $request, Context $context) {
        $creator = $context->getRequestCodeStorage();
        if (!$creator instanceof RequestCodeStorageInf) {
            throw new WrongClassTypeException();
        }
        $creator->data($request);
        $creator->add();
        $code = $creator->getCode();
        $this->reUrl($request,$code);
    }
}