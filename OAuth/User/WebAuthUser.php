<?php

/**
 * @class WebAuthUser
 * @author ShiO
 */
class WebAuthUser extends AuthUser{
    /**
     * @author ShiO
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPass() {
        return $this->pass;
    }

}