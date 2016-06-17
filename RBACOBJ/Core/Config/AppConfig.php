<?php
namespace Core\Config;

/**
 * @class AppConfig
 * @author ShiO
 * TODO::这里就是随便做一下
 */
class AppConfig implements Config {
    public $config;

    private static $_instance = null;

    private function __clone() {
    }

    public static function getInstance() {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
    }

    public function setConfig() {
        $this->config = array(
            'SQL_PATH' => './',
            'MESSAGE' => array(
                '200' => '成功',
            ),
        );
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getConfig() {
        $this->setConfig();
        return $this->config;
    }

    /**
     * @author ShiO
     * @param $key
     * @param null $code
     * @return mixed
     */
    public function findConfig($key, $code = null) {
        $this->setConfig();
        if ($code) {
            return $this->config[$key][$code];
        }
        return $this->config[$key];
    }
}
