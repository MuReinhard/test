<?php
namespace Gate\Ticket;
use Gate\Exception\WrongInputParamException;
use Gate\Exception\WrongPreposeMethodException;

/**
 * @class TicketManage
 * @author ShiO
 */
class TicketManage {
    public $ticketObjs = array();
    private $ticketObj;


    /**
     * @author ShiO
     * @param TicketInf $ticketObj
     */
    public function register(TicketInf $ticketObj) {
        $this->ticketObjs[] = $ticketObj;
    }

    /**
     * @author ShiO
     * @return self
     * @throws WrongInputParamException
     */
    public function createTicket() {
        // 区分票据的类型
        foreach ($this->ticketObjs as $ticketObj) {
            if ($ticketObj->isTicket()) {
                $this->ticketObj = $ticketObj;
                return $this;
            }
        }
        // 没有匹配的票据 抛出异常
        if ($this->ticketObj == null) {
            throw new WrongInputParamException();
        }
    }

    /**
     * @author ShiO
     * @param $passString
     * @return TicketManage
     * @throws
     */
    public function pushPassWord($passString) {
        if ($this->ticketObj == null) {
            throw new WrongPreposeMethodException();
        }
        $pass = new PassWord($passString);
        $this->ticketObj->setPassObj($pass);
        return $this;
    }

    /**
     * @author ShiO
     */
    public function getTicketObj() {
        return $this->getTicketObj();
    }
}