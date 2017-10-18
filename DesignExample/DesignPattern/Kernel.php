<?php

/**
 * @class Kernel
 * @author ShiO
 */
class Kernel implements IKernal {

    /**
     * @author ShiO
     */
    public function handle() {
        echo 'kernel处理请求 同时发布响应信息' .'<br />';
    }
}