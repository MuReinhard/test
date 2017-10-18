<?php
namespace Tool;

/**
 * @class IIterator
 * @author ShiO
 */
abstract class IIterator {
    public abstract function add($value);
    public abstract function del();
    public abstract function first();
    public abstract function last();
    public abstract function all();
}