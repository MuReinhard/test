<?php

/**
 * @class Adapter
 * @author ShiO
 */
class Adapter implements AdapterTargetInterface{
    // 目标对象
    private $target;

    /**
     * @author ShiO
     * Adapter constructor.
     * @param Target $target
     */
    public function __construct(Target $target) {
        $this->target = $target;
    }

    /**
     * @author ShiO
     * @return mixed
     * 调用目标的方法A
     */
    public function funA() {
        $this->target->funA();
    }

    /**
     * @author ShiO
     * @return mixed
     * 调用目标的方法B
     */
    public function funB() {
        $this->target->funA();
    }
}