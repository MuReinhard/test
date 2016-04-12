<?php
/**
 * @author ShiO
 */
class BaseException extends Exception{
    public function __construct($message, $code, Exception $previous) {
        if ($message == null) {
            $message = $messageArray[$code];
        }
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        parent::__toString(); // TODO: Change the autogenerated stub
    }

}