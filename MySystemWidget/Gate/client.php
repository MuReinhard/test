<?php
/**
 * @author ShiO
 */
use Gate\Model\UserTicketModel;
use Gate\Ticket\TicketManage;
use Gate\Auth\Auth;
use Gate\Ticket\TicketPhone;

// 无脑用法-结合request类 自动注入相关参数，匹配相关票据，以后可以做成数据集
$manage = new TicketManage();
$manage->register(new TicketPhone('156209'));
$ticket = $manage->createTicket()->pushPassWord('aaa')->getTicketObj();

$auth = new Auth();
$auth->login($ticket, new UserTicketModel());

// 简化用法
$ticket = new TicketPhone('1341');
$auth = new Auth();
$auth->login($ticket, new UserTicketModel());

// 特殊用法-自定义数据存储过程
$ticket = new TicketPhone('1341');
$auth = new Auth();
$auth->loginUserDefinedSave(function($userData){
    // 天知道你怎么存储
},$ticket, new UserTicketModel());
