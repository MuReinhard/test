<?php

/**
 * @class ConcreteClass
 * @author ShiO
 */
class ConcreteClass extends AbstractClass{

    /**
     * @author ShiO
     * @return mixed
     */
    protected function baseMethodOne() {
        echo '实现方法！';
    }

    /**
     * @author ShiO
     * @return mixed
     */
    protected function baseMethodTwo() {
        echo '实现方法2！';
    }
}