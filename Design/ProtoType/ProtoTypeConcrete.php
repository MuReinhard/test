<?php

/**
 * @class ProtoTypeConcrete
 * @author ShiO
 */
class ProtoTypeConcrete implements ProtoType{
    private $obj;

    /**
     * @author ShiO
     * ProtoTypeConcrete constructor.
     *
     * @param $obj
     */
    public function __construct($obj) {
        $this->obj = $obj;
    }

    /**
     * @author ShiO
     * 复制对象
     * @return mixed
     */
    public function copy() {
        // 浅复制
//        return clone $this;
        // 深复制
        $serializeObj = serialize($this);
        $cloneObj = unserialize($serializeObj);
        return $cloneObj;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getObj() {
        return $this->obj;
    }

    /**
     * @author ShiO
     * @param mixed $obj
     */
    public function setObj($obj) {
        $this->obj = $obj;
    }

}