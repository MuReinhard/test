<?php
namespace MySystemWidget\Gate\Exception;

use Exception;

/**
 * @class UserNotLoginException
 * @author ShiO
 */
class UserNotLoginException extends Exception {
    /**
     * @author ShiO
     * WrongInputParamException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = "", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}