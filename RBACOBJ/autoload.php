<?php
/**
 * @author ShiO
 * @param $name
 */
function __autoload($name) {
    $name = str_replace('\\', '/', $name);
    include_once './' . $name . '.php';
}