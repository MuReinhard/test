<?php
namespace Gate\SystemStorage;
/**
 * @class SessionService
 * @author ShiO
 */
class Session implements StorageInf {
    private static $instance;
    private $prefix;

    private function __construct() {
    }

    private function __clone() {
    }

    /**
     * @author ShiO
     * @return Session
     */
    public static function getInstance() {
        if (self::$instance == null) {
            $instance = new self();
            self::$instance = $instance;
        }
        return self::$instance;
    }

    /**
     * @author ShiO
     * @param $key
     * @param null $value
     * @return mixed
     */
    public function set($key = null, $value = null) {
        session($this->prefix . $key, $value);
    }

    /**
     * @author ShiO
     * @param $key
     * @return mixed
     */
    public function get($key = null) {
        return session($this->prefix . $key);
    }

    /**
     * @author ShiO
     * @param $prefix
     */
    public function setPrefix($prefix = null) {
        if ($prefix != null) {
            $this->prefix = $prefix . '.';
        } else {
            $this->prefix = null;
        }
    }

    /**
     * @author ShiO
     * @param null $prefix
     */
    public function clean($prefix = null) {
        if ($prefix != null) {
            $this->prefix = $prefix . '.';
            session($this->prefix, null);
        } else {
            $this->prefix = null;
            session(null);
        }
    }
}