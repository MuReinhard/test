<?php
namespace Core\Service\Context;

use Core\Config\Config;
use Core\Message;

interface Context {
    public function setAccording($context);

    public function getAccording();

    public function getResult();

    public function setResult($result);

    public function setMessageObj(Message $message);

    public function getMessageObj();

    public function getConfigObj();

    public function setConfigObj(Config $config);
}