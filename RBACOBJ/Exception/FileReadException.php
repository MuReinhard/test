<?php
namespace Exception;

use Exception;

/**
 * @class FileException
 * @author ShiO
 */
class FileReadException extends Exception {
    public function __construct($message = "", $code = 0, Exception $previous = null) {
    }
}