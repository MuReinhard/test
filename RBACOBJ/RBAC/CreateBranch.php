<?php
namespace RBAC;
/**
 * @class BuildRelation
 * @author ShiO
 */
class CreateBranch extends Branch {

    private $name;
    private $branch = array();
    private $items = array();
    private $obj;

    public function __construct($name,$obj = null) {
        $this->name = $name;
        $this->obj = $obj;
    }

    public function create() {
        foreach ($this->items as $item) {
            $arr = $item->create();
            $this->branch[$this->name][] = $arr;
        }
        if (empty($this->branch)) {
            $this->branch[$this->name] = array();
        }
        return $this->branch;
    }

    public function combination(tree $item) {
        $this->items[] = $item;
    }

    public function separation(tree $item) {
        $key = array_search($item, $this->items);
        if ($key !== false) {
            unset($this->items[$key]);
        }
    }

}