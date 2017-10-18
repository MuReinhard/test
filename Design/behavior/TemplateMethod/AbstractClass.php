<?php

/**
 * @class AbstractClass
 * @author ShiO
 */
abstract class AbstractClass {
    /**
     * @author ShiO
     * @return mixed
     */
    protected abstract function baseMethodOne();

    /**
     * @author ShiO
     * @return mixed
     */
    protected abstract function baseMethodTwo();

    /**
     * @author ShiO
     */
    public function templateMethod() {
        $this->baseMethodOne();
        $this->baseMethodTwo();
    }
}