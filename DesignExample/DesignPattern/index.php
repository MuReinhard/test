<?php
require_once 'IMiddeware.php';
require_once 'IRequest.php';
require_once 'IKernal.php';
require_once 'CookieMiddeware.php';
require_once 'Request.php';
require_once 'SessionMiddeware.php';
require_once 'Kernel.php';
require_once 'Client.php';

$client = new Client();
$client->getResponse();
