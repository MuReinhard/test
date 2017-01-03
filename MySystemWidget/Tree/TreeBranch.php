<?php
namespace Tree;
/**
 * @class TreeBranch
 * @author ShiO
 */
class TreeBranch implements TreeBranchInf {
    public $childs = array();
    public $data = array();

    /**
     * @author ShiO
     * TreeBranch constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * @author ShiO
     * @param TreeInf $tree
     * @return mixed
     */
    public function addChild(TreeInf $tree) {
        $this->childs[] = $tree;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getChilds() {
        return $this->childs;
    }

    /**
     * @author ShiO
     * @param string $child
     * @return mixed
     */
    public function toArray($child = '_child') {
        $temp = array();
        $data = $this->data;
        if ($this->childs) {
            foreach ($this->childs as $item) {
                $temp[] = $item->toArray($child);
            }
            $data[$child] = $temp;
        }
        return $data;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }
}