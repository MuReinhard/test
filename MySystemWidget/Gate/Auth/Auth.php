<?php
namespace Gate\Auth;

use Closure;
use Gate\Model\UserTicketModel;
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
     * 提供自定义储存用户数据的过程，不建议你这样做
     * @param Closure $func
     * @param TicketInf $ticket
     * @param UserTicketStorageInf $model
     */
    public function loginUserDefinedSave(Closure $func, TicketInf $ticket, UserTicketStorageInf $model) {
        if ($userData = $ticket->ticketCheck($model)) {
            // login成功
            call_user_func($func, $userData);
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

    /**
     * @author ShiO
     * @param $userData
     * @param TicketInf $ticket
     * @param UserTicketStorageInf $model
     */
    public function register($userData, TicketInf $ticket, UserTicketStorageInf $model) {
        $ticket->createUserAndTicket($userData, $model);
    }

    /**
     * @author ShiO
     * @param $userData
     * @param TicketInf $ticket
     * @param UserTicketStorageInf $model
     */
    public function registerAndLogin($userData, TicketInf $ticket, UserTicketStorageInf $model) {
        $ticket->createUserAndTicket($userData, $model);
        // 调用登录流程
        $this->login($ticket, $model);
    }

    /**
     * @author ShiO
     * @param TicketInf $ticket
     * @param UserTicketModel $model
     */
    public function bindTicket(TicketInf $ticket, UserTicketModel $model) {
        if ($ticket->ticketCheck($model)) {
            $loingB = LoginUserBeans::getInstance();
            $ticket->bindUser($loingB, $ticket, $model);
        }
    }
}