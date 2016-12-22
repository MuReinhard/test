<?php
namespace MySystemWidget\Tree\Exception;

use Exception;

/**
 * @class TreeException
 * @author ShiO
 */
class TreeException extends Exception {
    /**
     * @author ShiO
     * TreeException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = "", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}