<?php

/**
 * @class Client
 * @author ShiO
 */
class Client {
    protected $request;
    protected $response;

    public function __construct() {
        $this->request = new Request(new Kernel());
        $this->response = $this->wrapDecorator($this->request);
    }

    /**
     * @author ShiO
     * @param IMiddeware $decorator
     * @return CookieMiddeware
     */
    private function wrapDecorator(IMiddeware $decorator) {
        $decorator = new CookieMiddeware($decorator);
        $response = new SessionMiddeware($decorator);
        return $response;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getResponse() {
        return $this->response->handle();
    }


}