<?php
namespace Gate\Auth;

use Gate\Model\UserTicketStorageInf;
use Gate\SystemStorage\StorageInf;
use Gate\Ticket\TicketInf;

/**
 * @class Auth
 * @author ShiO
 */
class Auth {
    /**
     * @author ShiO
     * @param TicketInf $ticket
     * @param UserTicketStorageInf $model
     * @param StorageInf $drive
     * @return bool
     * @internal param LoginUserBeans $loginUserBeans
     */
    public function login(TicketInf $ticket, UserTicketStorageInf $model, StorageInf $drive = null) {
        // 控制检查是否可以登录，和后面的储存流程
        if ($userData = $ticket->ticketCheck($model)) {
            // login成功
            $loginUserBeans = LoginUserBeans::getInstance($drive);
            $loginUserBeans->saveLoginData('', $userData);
        }
    }

    /**
     * @author ShiO
     * @param StorageInf|null $drive
     */
    public function loginOut(StorageInf $drive = null) {
        $loginUserBeans = LoginUserBeans::getInstance($drive);
        $loginUserBeans->cleanLoginData();
    }
}