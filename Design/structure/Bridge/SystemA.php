<?php

/**
 * @class RefinedAbstraction
 * @author ShiO
 */
class SystemA extends BridgeAbs{

    public function BridgeAbsFun() {
        $this->systmeB->BridgeFun();
    }
}