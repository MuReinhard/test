<?php

interface ReflectionInf {
    /**
     * @author ShiO
     * @return mixed
     */
    public function init();

    /**
     * @author ShiO
     * @return mixed
     */
    public function getReflectionResult();

    /**
     * @author ShiO
     * @param $reflectionResult
     * @return mixed
     */
    public function setReflectionResult($reflectionResult);

}