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
    public function findUserDataByTicketAndPass($ticket,$type,$ticketPass);
}