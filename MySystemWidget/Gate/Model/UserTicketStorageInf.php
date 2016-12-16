<?php
namespace Gate\Model;

/**
 * @class UserStorageInf
 * @author ShiO
 */

interface UserTicketStorageInf {
    /**
     * @author ShiO
     * @param $ticketStr
     * @return mixed
     */
    public function findUserDataByTicket($ticketStr);

    /**
     * @author ShiO
     * @param $ticket
     * @param $type
     * @return mixed
     */
    public function findUserDataByTicketAndType($ticket, $type);

    /**
     * @author ShiO
     * @param $ticket
     * @param $type
     * @param $ticketPass
     * @return mixed
     */
    public function findUserDataByTicketAndPass($ticket, $type, $ticketPass);

    /**
     * @author ShiO
     * @param $ticket
     * @param $type
     * @return mixed
     */
    public function findTicketDataByTicketAndType($ticket, $type);

    /**
     * @author ShiO
     * @param $data
     * @return mixed
     */
    public function addUserData($data);

    /**
     * @author ShiO
     * @param $userId
     * @param $ticket
     * @param $type
     * @return mixed
     */
    public function addTicketDataByUserId($userId, $ticket, $type);

    /**
     * @author ShiO
     * @param $userId
     * @param $ticket
     * @param $type
     * @param $ticketPass
     * @return mixed
     */
    public function addTicketDataWithPassByUserId($userId, $ticket, $type, $ticketPass);

    /**
     * @author ShiO
     * @param $userId
     * @param $ticktId
     * @return mixed
     */
    public function contactTicketUserRelation($userId, $ticktId);
}