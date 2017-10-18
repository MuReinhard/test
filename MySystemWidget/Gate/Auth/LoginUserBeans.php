<?php
namespace Gate\Auth;
use Gate\SystemStorage\Session;
use Gate\SystemStorage\StorageInf;


/**
 * @class LoginBeansService
 * @author ShiO
 */
class LoginUserBeans {
    private static $instance;
    private $prefix = 'home::login';
    private static $drive;

    private function __construct() {
    }


    private function __clone() {
    }

    /**
     * @author ShiO
     * @param $drive
     * @return LoginUserBeans
     */
    public static function getInstance(StorageInf $drive = null) {
        if ($drive == null) {
            self::$drive = Session::getInstance();
        } else {
            self::$drive = $drive;
        }
        if (self::$instance == null) {
            $instance = new self();
            self::$instance = $instance;
        }
        return self::$instance;
    }

    /**
     * @author ShiO
     * @param $key
     * @param $value
     * @return
     */
    public function saveLoginData($key = null, $value) {
        $storage = self::$drive;
        $storage->setPrefix($this->prefix);
        return $storage->set($key, $value);
    }

    /**
     * @author ShiO
     * @param null $key
     * @return mixed
     */
    public function getLoginData($key = null) {
        $storage = self::$drive;
        $storage->setPrefix($this->prefix);
        return $storage->get($key);
    }

    /**
     * @author ShiO
     */
    public function getLoginUid() {
        $storage = self::$drive;
        $storage->setPrefix($this->prefix);
        return $storage->get('user_id');
    }

    /**
     * @author ShiO
     * @param $key
     * @param $value
     * @internal param $data
     */
    public function appendLoginData($key, $value) {
        $storage = self::$drive;
        $storage->setPrefix($this->prefix);
        $storage->set($key, $value);
    }

    /**
     * @author ShiO
     */
    public function cleanLoginData() {
        $storage = self::$drive;
        $storage->setPrefix($this->prefix);
        $storage->clean();
    }
}