<?php

/**
 * @class SystemReflectionClass
 * @author ShiO
 */
class SystemReflectionClass implements ReflectionInf{
    private $obj;
    private $reflectionResult;

    /**
     * @author ShiO
     * SystemReflectionClass constructor.
     * @param $kernel
     */
    public function __construct($kernel) {
        $this->obj = $kernel;
    }

    /**
     * @author ShiO
     */
    public function init() {
        $reClass = new ReflectionClass(get_class($this->obj));
        $params = $reClass->getProperties();
        for ($i = 0; $i < sizeof($params); $i++) {
            $key = $params[$i]->name;
            $param = $this->obj->$key;
            $arr = array();
            foreach ($param as $class) {
                $configClass = new ReflectionClass($class);
                $arr['class'] = $class;
                $initMethod = $configClass->getMethod('init');
                $arr['method'] = $initMethod->name;
                $arr['param'] = $initMethod->getParameters();
            }
            $this->reflectionResult[] = $arr;
        }
    }

    /**
     * @author ShiO
     */
    public function inval() {
        $arr = $this->reflectionResult;
        foreach ($arr as $key) {
            $class = new ReflectionClass($arr[$key]['class']);
            $instance = $class->newInstanceArgs();
            $method = $class->getMethod($arr[$key]['method']);
            $method->invoke($instance,$arr[$key]['paramValue']);
        }
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getReflectionResult() {
        return $this->reflectionResult;
    }

    /**
     * @author ShiO
     * @param mixed $reflectionResult
     * @return mixed|void
     */
    public function setReflectionResult($reflectionResult) {
        $this->reflectionResult = $reflectionResult;
    }
}