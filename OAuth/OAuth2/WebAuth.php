<?php

/**
 * @class SilentAuth
 * @author ShiO
 */
class WebAuth extends Auth {

    /**
     * @author ShiO
     * @param Request $request
     * @param Context $context
     */
    public function auth(Request $request, Context $context) {
        if ($request->getGet()['agree'] == 'agree') {
            $creator = $context->getAuthCreator();
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