<?php

/**
 * @class CookieMiddware
 * @author ShiO
 */
class CookieMiddeware implements IMiddeware{
    private $middeware;

    public function __construct(IMiddeware $middeware) {
        $this->middeware = $middeware;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function handle() {
        echo '我是cookie的中间件'.'<br />';
        $this->middeware->handle();
        echo '我是cookie的中间件后置'.'<br />';
    }
}