<?php
namespace Core;
use Tool\SimpleArrIterator;

/**
 * @class Message
 * @author ShiO
 */
class Message {
    public $messageArr;

    public function __construct() {
        $this->messageArr = new SimpleArrIterator(array());
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getMessage() {
        return $this->messageArr->all();
    }

    /**
     * @author ShiO
     * @param mixed $message
     */
    public function setMessage($message) {
        $this->messageArr->add($message);
    }
}