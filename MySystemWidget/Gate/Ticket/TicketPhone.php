<?php
namespace Gate\Ticket;

use Gate\Exception\NotFoundTicketException;
use Gate\Exception\WrongPassWordException;
use Gate\Model\UserTicketModel;
use Gate\Model\UserTicketStorageInf;
use MySystemWidget\Gate\Exception\TicketExistException;

/**
 * @class TicketPhone
 * @author ShiO
 */
class TicketPhone implements TicketInf {
    public $value;
    private $type = UserTicketModel::TICKET_PHONE;
    public $passObj;

    /**
     * @author ShiO
     * TicketPhone constructor.
     * @param $value
     */
    public function __construct($value) {
        $this->value = $value;
    }

    /**
     * @author ShiO
     */
    public function getTicketValue() {
        return $this->value;
    }

    /**
     * @author ShiO
     */
    public function getTicketType() {
        return $this->value;
    }

    /**
     * @author ShiO
     * @param UserTicketStorageInf $model
     * @return bool
     * @throws NotFoundTicketException
     * @throws WrongPassWordException
     */
    public function ticketCheck(UserTicketStorageInf $model) {
        // phone的check方式
        $userData = $model->findUserDataByTicketAndType($this->value, $this->type);
        if ($userData) {
            // 检查password
            if ($this->passObj->isMainPassCorrect($userData[0]['id'], $userData[0]['salt'])) {
                return true;
            } else {
                throw new WrongPassWordException();
            }
        } else {
            throw new NotFoundTicketException();
        }
    }

    /**
     * @author ShiO
     * @param $userData
     * @param UserTicketStorageInf $model
     * @throws TicketExistException
     */
    public function createUserAndTicket($userData, UserTicketStorageInf $model) {
        $ticketData = $model->findTicketDataByTicketAndType($this->value, $this->type);
        if (!$ticketData) {
            // 票据不存在
            $userId = $model->addUserData($userData);
            $model->addTicketDataByUserId($userId, $this->value, $this->type);
        } else {
            throw new TicketExistException();
        }
    }

    /**
     * @author ShiO
     * @param PassWordInc $passObj
     */
    public function setPassObj(PassWordInc $passObj) {
        $this->passObj = $passObj;
    }

    /**
     * @author ShiO
     * @param $ticketStr
     * @return bool
     */
    public function isTicket($ticketStr) {
        return true;
    }
}
