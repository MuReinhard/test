<?php
include 'autoload.php';
/**
 * @author ShiO
 */
$builder = new BuilderConcrete();
$director = new Director($builder);
$director->build();
$builder->getResult();