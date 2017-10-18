<?php

interface TreeManageInf {
    /**
     * @author ShiO
     * TreeManageInf constructor.
     * @param Closure|null $crateFun
     */
    public function __construct(Closure $crateFun = null);

    /**
     * @author ShiO
     * @param $data
     * @return mixed
     */
    public function crateTree($data);

    /**
     * @author ShiO
     * @param $data
     * @return mixed
     */
    public function crateItem($data);
}