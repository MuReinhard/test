<?php
/**
 * @author ShiO
 */
use Core\Service\SearchStrategy\SqlSearchClint;
use Model\RbacPermissionModel;

include_once 'autoload.php';

$clint = new SqlSearchClint();
$model = new RbacPermissionModel();
$clint->setBasisModel($model);
$context = $clint->searchSqlData();
echo $context->getResult();