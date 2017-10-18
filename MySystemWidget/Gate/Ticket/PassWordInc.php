<?php
namespace Gate\Ticket;
/**
 * @class PassWordInc
 * @author ShiO
 */

interface PassWordInc {
    /**
     * @author ShiO
     * PassWordInc constructor.
     * @param $passStr
     */
    public function __construct($passStr);

    /**
     * @author ShiO
     * @param $userId
     * @param $salt
     * @return mixed
     */
    public function isMainPassCorrect($userId, $salt);

    /**
     * @author ShiO
     * @param $pass
     * @param $salt
     * @return mixed
     */
    public function passEncrypt($pass, $salt);

}