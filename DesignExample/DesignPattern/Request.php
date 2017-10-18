<?php

/**
 * @class Request
 * @author ShiO
 */
class Request implements IRequest {
    private $kernel;

    /**
     * @author ShiO
     * Request constructor.
     * @param IKernal $kernal
     */
    public function __construct(IKernal $kernal) {
        $this->kernel = $kernal;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getRequest() {
        return $this;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function handle() {
        echo 'Requset:在启动所有中间件前，启动request'.'<br />';
//        $this->kernel->handle();
        echo 'Requset:在启动所有中间件后'.'<br />';
    }
}