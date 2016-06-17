<?php
namespace Exception;
use Exception;

/**
 * @class SearchContextError
 * @author ShiO
 */
class SearchContextErrorException extends Exception{
    public function __construct($message = "", $code = 0, Exception $previous = null) {
        parent::__construct($message = "", $code = 0, $previous = null);
    }
}