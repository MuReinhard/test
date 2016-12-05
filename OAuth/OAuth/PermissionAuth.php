<?php

/**
 * @class BaseAuth
 * @author ShiO
 */
class PermissionAuth extends AuthChain {

    /**
     * @author ShiO
     * @param Request $request
     * @param Context $context
     * @throws PermissionDeniedException
     */
    public function auth(Request $request, Context $context) {
        $application = $context->getApplication();
        $config = $context->getConfig();
        if (!$application->getPermission()->match($config->getPermission())) {
            throw new PermissionDeniedException();
        } else {
            $this->next->auth($request, $context);
        }
    }
}