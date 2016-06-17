<?php
/**
 * @author ShiO
 * @param $name
 */
function __autoload($name)
{
    include_once $name . '.php';
    include_once 'RBAC/'.$name . '.php';
    include_once 'Model/'.$name . '.php';
    include_once 'Action/'.$name . '.php';
}