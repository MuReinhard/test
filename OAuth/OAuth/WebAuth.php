<?php

/**
 * @class SilentAuth
 * @author ShiO
 */
class WebAuth extends AuthChain {

    /**
     * @author ShiO
     * @param Request $request
     * @param Context $context
     * @throws WrongClassTypeException
     */
    public function auth(Request $request, Context $context) {
        if ($request->getGet()['agree'] == 'agree') {
            $creator = $context->getRequestCodeStorage();
            $creator->data($request);
            $creator->add();
            $code = $creator->getCode();
            $this->reUrl($request, $code);
        } else {
            // 显示授权页面
            $this->display('');
        }
    }
}