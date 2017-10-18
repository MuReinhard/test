<?php
/**
 * @author ShiO
 */
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class).'.php';
    require $class;
});
