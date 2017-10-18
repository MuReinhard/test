<?php
/**
 * @author ShiO
 * @param $name
 */
function __autoload($name)
{
    include_once $name . '.php';
}