<?php
namespace Tool;

/**
 * @class SimpleIterator
 * @author ShiO
 */
class SimpleArrIterator extends IIterator{
    public $data;

    public function __construct(array $data) {
        $this->data = $data;
    }

    /**
     * @author ShiO
     * @param $value
     */
    public function add($value) {
        $this->data[] = $value;
    }

    /**
     * @author ShiO
     */
    public function del() {
        array_pop($this->data);
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function first() {
        return reset($this->data);
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function last() {
        return end($this->data);
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function next() {
        return next($this->data);
    }
}