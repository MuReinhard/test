<?php


/**
 * @author ShiO
 */
use Model\RbacPermissionModel;
use Model\RbacRoleModel;
use Model\RbacRolePermissionRelationModel;
use RBAC\CreateBranch;
use RBAC\CreateLeaf;

include_once 'autoload.php';
include_once 'function.php';
$leaf_1 = new createLeaf('a', new RbacPermissionModel());
$leaf_2 = new createLeaf('b', new RbacRoleModel());

$branch_1 = new createBranch('hi', new RbacRolePermissionRelationModel());
$branch_1->combination($leaf_1);
$branch_1->combination($leaf_2);

dump($branch_1->create());
