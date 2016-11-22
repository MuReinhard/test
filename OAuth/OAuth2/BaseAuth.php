<?php

/**
 * @class BaseAuth
 * @author ShiO
 */
class BaseAuth extends Auth {

    /**
     * @author ShiO
     * @param Request $request
     * @param Context $context
     * @throws PermissionDeniedException
     */
    public function auth(Request $request, Context $context) {
        if (!$this->application->getPermission()->match($context->getConfig()->getPermission())) {
            throw new PermissionDeniedException();
        } else {
            $this->next->auth($request, $context);
        }
    }
}