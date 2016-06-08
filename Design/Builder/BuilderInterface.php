<?php
/**
 * @author ShiO
 * 建造者接口
 */
interface BuilderInterface
{
    /**
     * @author ShiO
     * 流程A
     * @return mixed
     */
    public function buildPartA();

    /**
     * @author ShiO
     * 流程B
     * @return mixed
     */
    public function buildPartB();
}