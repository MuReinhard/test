<?php
namespace Gate\Ticket;
use Gate\Model\UserTicketStorageInf;

/**
 * @class TicketInf
 * @author ShiO
 */

interface TicketInf {
    public function getTicketValue();
    public function getTicketType();
    public function ticketCheck(UserTicketStorageInf $model);
    public function setPassObj(PassWordInc $passObj);
    public function isTicket($ticketStr);
    public function createUserAndTicket($userData,UserTicketStorageInf $model);
}