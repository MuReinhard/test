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
        return $data;
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
        return $data;
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
        return $data;
    }

    /**
     * @author ShiO
     * @param $data
     * @return mixed
     */
    public function addUserData($data) {
        $result = $this->data($data)->addData();
        return $result;
    }

    /**
     * @author ShiO
     * @param $userId
     * @param $ticket
     * @param $type
     * @return mixed
     */
    public function addTicketDataByUserId($userId, $ticket, $type) {
        $data = array(
            'ticket_value' => $ticket,
            'ticket_type' => $type,
            'user_id' => $userId,
        );
        $result = $this->data($data)->addData();
        return $result;
    }

    /**
     * @author ShiO
     * @param $userId
     * @param $ticket
     * @param $type
     * @param $ticketPass
     * @return mixed
     */
    public function addTicketDataWithPassByUserId($userId, $ticket, $type, $ticketPass) {
        $data = array(
            'ticket_value' => $ticket,
            'ticket_type' => $type,
            'ticket_pass' => $ticketPass,
            'user_id' => $userId,
        );
        $result = $this->data($data)->addData();
        return $result;
    }

    /**
     * @author ShiO
     * @param $ticket
     * @param $type
     * @return mixed
     */
    public function findTicketDataByTicketAndType($ticket, $type) {
        $data = array(
            'ticket_value' => $ticket,
            'ticket_type' => $type,
        );
        $result = $this->data($data)->addData();
        return $result;
    }

    /**
     * @author ShiO
     * @param $userId
     * @param $ticktId
     * @return mixed
     */
    public function contactTicketUserRelation($userId, $ticktId) {
        $data = array(
            'user_id'=> $userId,
            'ticket_id' => $ticktId,
        );
        $result = $this->data($data)->saveData();
        return $result;
    }
}