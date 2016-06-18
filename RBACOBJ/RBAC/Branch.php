<?php
namespace RBAC;
/**
 * @class ModelRelation
 * @author ShiO
 */
abstract class Branch extends Tree{
    abstract function combination(Tree $item);
    abstract function separation(Tree $item);
}