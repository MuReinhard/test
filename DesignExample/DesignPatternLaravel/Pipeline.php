<?php
namespace DesignPatternLaravel\Croe;

// PipelineTest.php

use Closure;

class Pipeline {
    /**
     * @var array
     */
    protected $middlewares = [];

    /**
     * @var int
     */
    protected $request;

    /**
     * @author ShiO
     * @param Closure $destination
     * @return Closure
     */
    public function getInitialSlice(Closure $destination) {
        return function ($passable) use ($destination) {
            return call_user_func($destination, $passable);
        };
    }

    /**
     * @author ShiO
     * @return Closure
     */
    public function getSlice() {
        return function ($stack, $pipe) {
            return function ($passable) use ($stack, $pipe) {
                return call_user_func_array([$pipe, 'handle'], [$passable, $stack]);
            };
        };
    }

    /**
     * @author ShiO
     * @param $request
     * @return $this
     */
    public function send($request) {
        $this->request = $request;
        return $this;
    }

    /**
     * @author ShiO
     * @param array $middlewares
     * @return $this
     */
    public function through(array $middlewares) {
        $this->middlewares = $middlewares;
        return $this;
    }

    /**
     * @author ShiO
     * @param Closure $destination
     * @return mixed
     */
    public function then(Closure $destination) {
        $firstSlice = $this->getInitialSlice($destination);
        $pipes = array_reverse($this->middlewares);
        $run = array_reduce($pipes, $this->getSlice(), $firstSlice);
        return call_user_func($run, $this->request);
    }
}