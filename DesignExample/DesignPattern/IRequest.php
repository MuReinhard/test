<?php

/**
 * @class IComponent
 * @author ShiO
 */
interface IRequest extends IMiddeware{
    /**
     * @author ShiO
     * @return mixed
     */
    public function getRequest();
}