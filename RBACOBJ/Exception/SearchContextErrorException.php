<?php
namespace Exception;
use Exception;

/**
 * @class SearchContextError
 * @author ShiO
 */
class SearchContextErrorException extends Exception{
    public function __construct($message = "", $code = 0, Exception $previous = null) {
    }
}