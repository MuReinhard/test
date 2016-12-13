<?php
namespace Gate\Exception;
use Exception;

/**
 * @class WrongPassWordException
 * @author ShiO
 */
class WrongPassWordException extends Exception{
    /**
     * @author ShiO
     * NotFoundTicketException constructor.
     * @param string $message
     * @param int $code
     * @param Exception $previous
     */
    public function __construct($message = "", $code = 0, Exception $previous = null) {
        parent::__construct($message,$code,$previous);
    }
}