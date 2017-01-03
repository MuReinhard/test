<?php
namespace Tree;
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
     */
    public function __construct($data);
}