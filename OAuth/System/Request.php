<?php

/**
 * @class Request
 * @author ShiO
 */
class Request {
    private $get;

    /**
     * @author ShiO
     * @param mixed $get
     */
    public function setGet($get) {
        $this->get = $get;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getGet() {
        return $this->get;
    }
}