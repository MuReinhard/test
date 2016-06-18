<?php
namespace RBAC;

use Exception;

class createLeaf extends Tree {

    private $name;
    private $leaf = array();
    private $obj;

    public function __construct($name,$obj = null) {
        $this->name = $name;
        $this->obj = $obj;
    }

    public function create() {
        $this->leaf[$this->name] = $this->obj;
        return $this->leaf;
    }

    public function combination(Tree $item) {
        throw new Exception("本类不支持组合操作");
    }

    public function separation(Tree $item) {
        throw new Exception("本类不支持分离操作");
    }
}