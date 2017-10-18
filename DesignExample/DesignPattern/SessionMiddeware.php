<?php

/**
 * @class SessionMiddeware
 * @author ShiO
 */
class SessionMiddeware implements IMiddeware{
    private $middeware;

    public function __construct(IMiddeware $middeware) {
        $this->middeware = $middeware;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function handle() {
        echo '我是session的中间件'.'<br />';
        $this->middeware->handle();
    }
}