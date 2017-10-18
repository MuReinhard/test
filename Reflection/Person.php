<?php

/**
 * @author ShiO
 */
class Person {
    private $_allowDynamicAttributes = false;
    protected $id = 0;
    protected $name;

    protected $biography;

    public function getId() {
        return $this->id;
    }

    public function setId($v) {
        $this->id = $v;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($v) {
        $this->name = $v;
    }

    public function getBiography() {
        return $this->biography;
    }

    public function setBiography($v) {
        $this->biography = $v;
    }
}