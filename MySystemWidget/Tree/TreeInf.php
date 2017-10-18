<?php
namespace Tree;
use Closure;

/**
 * @interface TreeInf
 * @author ShiO
 */
interface TreeInf {
    /**
     * @author ShiO
     * @return mixed
     */
    public function getData();

    /**
     * @author ShiO
     * TreeInf constructor.
     * @param $data
     * @param $crateFun
     */
    public function __construct($data, Closure $crateFun);
}