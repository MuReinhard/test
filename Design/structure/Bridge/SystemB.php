<?php

/**
 * @class ImplementorConcreteA
 * @author ShiO
 */
class SystemB implements BridgeInterface {


    /**
     * @author ShiO
     * @return mixed
     * 被桥接方法
     */
    public function BridgeFun() {
        echo 'hi';
    }
}