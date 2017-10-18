<?php
namespace Gate\Ticket;
/**
 * @class PassWord
 * @author ShiO
 */
class PassWord implements PassWordInc {
    private $password;

    /**
     * @author ShiO
     * PassWord constructor.
     * @param $password
     */
    public function __construct($password) {
        $this->password;
    }

    /**
     * @author ShiO
     * @param $userId
     * @param $salt
     * @return mixed|void
     */
    public function isMainPassCorrect($userId, $salt) {
        // 检查mainPass是否正确
        // 用户传进来的password
        $pass = $this->passEncrypt($this->password,$salt);
        $where = array(
            'user_id' => array('eq',$userId),
            'pass' => array('eq',$pass),
            'salt' => array('eq',$salt),
        );
        return $this->where($where)->select();
    }

    /**
     * @author ShiO
     * @param $pass
     * @param $salt
     * @return mixed
     */
    public function passEncrypt($pass, $salt) {
        return $pass;
    }
}