<?php

class System {
    protected $instance;
    protected $instances;
    protected $aliases;
    protected $bindings;
    protected $contextual;
    protected $buildStack;


    public function __construct($basePath = null) {
        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
        $this->registerCoreContainerAliases();
        if ($basePath) {
            $this->setBasePath($basePath);
        }

    }

    protected function registerBaseBindings() {
        $this->instance('system', $this);
        $this->instance('Illuminate\Container\Container', $this);

    }

    /**
     * @author ShiO
     * @param $abstract
     * @param $instance
     */
    public function instance($abstract, $instance) {
        if (is_array($abstract)) {
            list($abstract, $alias) = $this->extractAlias($abstract);

            $this->alias($abstract, $alias);
        }
        unset($this->aliases[$abstract]);

        $bound = $this->bound($abstract);
        $this->instance[$abstract] = $instance;
        if ($bound) {
            $this->rebound($abstract);
        }
    }

    /**
     * @author ShiO
     * @param array $definition
     * @return array
     */
    protected function extractAlias(array $definition) {
        return [key($definition), current($definition)];
    }

    /**
     * @author ShiO
     * @param $abstract
     * @param $alias
     */
    protected function alias($abstract, $alias) {
        $this->aliases[$alias] = $abstract;
    }

    /**
     * @author ShiO
     * @param $abstract
     * @return bool
     */
    protected function bound($abstract) {
        return isset($this->bindings[$abstract]) || isset($this->instances[$abstract]) || $this->isAlias($abstract);
    }

    /**
     * @author ShiO
     * @param $abstract
     */
    protected function rebound($abstract) {
        $instance = $this->make($abstract);

        foreach ($this->getReboundCallbacks($abstract) as $callback) {
            call_user_func($callback, $this, $instance);
        }
    }

    /**
     * @author ShiO
     * @param $abstract
     * @param array $parameters
     */
    public function make($abstract, array $parameters = []) {
        $abstract = $this->getAlias($abstract);

        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        $concrete = $this->getConcrete($abstract);
        if ($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete, $parameters);
        } else {
            $object = $this->make($concrete, $parameters);
        }
        foreach ($this->getExtenders($abstract) as $extender) {
            $object = $extender($object, $this);
        }

        if ($this->isShared($abstract)) {
            $this->instances[$abstract] = $object;
        }

        $this->fireResolvingCallbacks($abstract, $object);

        $this->resolved[$abstract] = true;

        return $object;
    }

    /**
     * @author ShiO
     * @param $abstract
     * @return mixed
     */
    protected function getAlias($abstract) {
        return isset($this->aliases[$abstract]) ? $this->aliases[$abstract] : $abstract;
    }

    /**
     * @author ShiO
     * @param $abstract
     * @return string
     */
    protected function getConcrete($abstract) {
        if (!is_null($concrete = $this->getContextualConcrete($abstract))) {
            return $concrete;
        }

        if (!isset($this->bindings[$abstract])) {
            if ($this->missingLeadingSlash($abstract) &&
                isset($this->bindings['\\' . $abstract])
            ) {
                $abstract = '\\' . $abstract;
            }

            return $abstract;
        }

        return $this->bindings[$abstract]['concrete'];
    }

    /**
     * @author ShiO
     * @param $abstract
     * @return mixed
     */
    protected function getContextualConcrete($abstract) {
        if (isset($this->contextual[end($this->buildStack)][$abstract])) {
            return $this->contextual[end($this->buildStack)][$abstract];
        }
    }

}

$a = 'xx';
echo $a;
$a = $a .'2222';
echo $a;