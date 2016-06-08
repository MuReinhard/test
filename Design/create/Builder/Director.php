<?php
/**
 * @author ShiO
 */
class Director{
    private $builder;

    /**
     * @author ShiO
     * Director constructor.
     * 建造工具对象的传入，以及启动建造流程
     * @param $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     * @author ShiO
     * 开始建造流程
     */
    public function build()
    {
        $this->builder->buildPartA();
        $this->builder->buildPartB();
    }
}