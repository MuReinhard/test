<?php
namespace Gate\Model;

/**
 * @class UserModel
 * @author ShiO
 */
class UserTicketModel implements UserTicketStorageInf {
    const TICKET_PHONE = 'phone';

    /**
     * @author ShiO
     * @param $ticket
     * @return boolean
     */
    public function findUserDataByTicket($ticket) {
        $where = array(
            'value' => array('eq', $ticket),
        );
        $data = $this->where($where)->select();
        return $data ? true : false;
    }

    /**
     * @author ShiO
     * @param $ticket
     * @param $type
     * @return mixed
     */
    public function findUserDataByTicketAndType($ticket, $type) {
        $where = array(
            'value' => array('eq', $ticket),
            'type' => array('eq', $type),
        );
        $data = $this->where($where)->select();
        return $data ? true : false;
    }

    /**
     * @author ShiO
     * @param $ticket
     * @param $type
     * @param $ticketPass
     * @return mixed
     */
    public function findUserDataByTicketAndPass($ticket, $type, $ticketPass) {
        $where = array(
            'value' => array('eq', $ticket),
            'type' => array('eq', $type),
            'pass' => array('eq', $ticketPass),
        );
        $data = $this->where($where)->select();
        return $data ? true : false;
    }
}