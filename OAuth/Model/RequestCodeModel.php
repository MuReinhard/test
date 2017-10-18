<?php

/**
 * @class RequestCodeModel
 * @author ShiO
 */
class RequestCodeModel implements RequestCodeStorageInf {
    const SNSAPI_BASE = 1;
    const SNSAPI_USERINFO = 2;
    public $data;

    /**
     * @author ShiO
     */
    public function create() {
        $this->addData();
    }

    /**
     * @author ShiO
     * @param $data
     */
    public function data($data) {
        $this->data = $data;
    }
}