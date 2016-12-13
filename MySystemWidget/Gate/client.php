<?php
/**
 * @author ShiO
 */
use Gate\Model\UserTicketModel;
use Gate\Ticket\TicketManage;
use Gate\Auth\Auth;
use Gate\Ticket\TicketPhone;

// 无脑用法
$manage = new TicketManage();
$manage->register(new TicketPhone('156209'));
$ticket = $manage->createTicket()->pushPassWord('aaa')->getTicketObj();

$auth = new Auth();
$auth->login($ticket, new UserTicketModel());

// 简化用法
$ticket = new TicketPhone('1341');
$auth = new Auth();
$auth->login($ticket, new UserTicketModel());
