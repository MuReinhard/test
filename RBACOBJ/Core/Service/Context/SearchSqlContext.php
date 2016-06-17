<?php
namespace Core\Service\Context;

use Core\Config\Config;
use Core\Message;
use Model\Model;

/**
 * @class SearchContext
 * @author ShiO
 */
class SearchSqlContext implements Context {
    public $result;
    public $according;
    public $messageObj;
    public $configObj;

    /**
     * @author ShiO
     * @return mixed
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getAccording() {
        return $this->according;
    }

    /**
     * @author ShiO
     * @param mixed $according
     */
    public function setAccording($according) {
        $this->according = $according;
    }

    public function setMessageObj(Message $message) {
        $this->messageObj = $message;
    }

    public function getMessageObj() {
        return $this->messageObj;
    }

    public function setResult($result) {
        $this->result = $result;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getConfigObj() {
        return $this->configObj;
    }

    /**
     * @author ShiO
     * @param Config $config
     */
    public function setConfigObj(Config $config) {
        $this->configObj = $config;
    }
}