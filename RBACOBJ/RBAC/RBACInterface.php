<?php
namespace RBAC;
use Tool\SimpleArrIterator;

/**
 * @class RBACInterface
 * @author ShiO
 */
class RBACInterface {
    public $RBACGearObjArr;
    public $RBACGearObj;
    /**
     * @author ShiO
     */
    public function initRBAC() {
        $this->RBACGearObjArr = new SimpleArrIterator(array());
    }

    /**
     * @author ShiO
     * @param array $RBACGearObj
     */
    public function setRBACGearObj($RBACGearObj) {
        $this->RBACGearObjArr->add($RBACGearObj);
    }

    /**
     * @author ShiO
     */
    public function create() {
        $this->RBACGearObjArr->next()->build();

    }


}