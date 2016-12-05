<?php

/**
 * @class WrongClassTypeException
 * @author ShiO
 */
class WrongClassTypeException extends Exception{

    /**
     * @author ShiO
     * WrongClassTypeException constructor.
     * @param string $message
     * @param int $code
     * @param Exception $previous
     */
    public function __construct($message = "", $code = 0, Exception $previous = null) {
        parent::__construct($message = "", $code = 0, $previous = null);
    }
}