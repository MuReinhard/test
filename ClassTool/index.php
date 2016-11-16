<?php
/**
 * @author ShiO
 */
/*
文件获取类
1.本地文件流读取
2.本地文件路径
3.远程文件路径
2.远程流读取
3.直接得到文件流

1> 地址-》 本地文件读取 流
2> 上一步操作得到的流 -> 本地文件读取 -> 流
3> 地址-》 远程文件读取-> 流
3> 地址-》 远程文件下载-> 本地文件读取 -> 流
4> 文件流

类统合
1.本地文件操作类(读取)
2.远程文件操作类 (读取 || 下载)
3.文件下载类(下载 -> 流|| 文件地址)
4.流程控制类 (上下文||最后流程)
5.辅助类-CURL通讯类
6.操作类-识别接口
*/

class FileSocket {
    /**
     * @author ShiO
     * @param $param
     * @return FileTream|LocalFile
     */
    public function cognizeAction($param) {
        if ($param == $this->isFilePath($param)) {
            return new LocalFile($param);
        } elseif ($param == $this->isFileTream($param)) {
            return new FileTream($param);
        }
    }

    /**
     * @author ShiO
     * @param $path
     * @return bool
     */
    private function isFilePath($path) {
        return true;
    }

    /**
     * @author ShiO
     * @param $tream
     * @return bool
     */
    private function isFileTream($tream) {
        return true;
    }
}

$param = '';
$socket = new FileSocket();
$socket->cognizeAction($param)->writer()->save();

interface File {
    public function read();
}


class LocalFile implements File {
    public $filePath;
    public $fileName;
    public $fileTream;

    public function __construct($path) {
        $this->pathAnalysis($path);
    }

    /**
     * @author ShiO
     */
    public function read() {
        if (!$this->checkFileExist()) {
            throw new FileNotExistException();
        }
        $class = new FilePersmission();
        if (!$class->check(FilePersmission::FileRead)) {
            if ($class->need(FilePersmission::FileRead)) {
                // 读取文件
                $tream = fopen($this->filePath, 'r');
                $this->fileTream = new FileTream($tream);
                return $this->fileTream;
            }
        }
    }

    /**
     * @author ShiO
     * @param $path
     */
    private function pathAnalysis($path) {
        // TODO::解析path中的关键字
        $this->filePath = $path;
        $name = '';
        $this->fileName = $name;
    }

    /**
     * @author ShiO
     */
    private function checkFileExist() {
        if (file_exists($this->filePath)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @author ShiO
     */
    public function writer() {
        // 写入文件
        fwrite($this->fileTream->getFileTream(), '');
        return $this;
    }

    /**
     * @author ShiO
     * 创造文件
     */
    public function create() {
        $this->fileTream = new FileTream(fopen($this->filePath, 'w'));
        return $this;
    }

    /**
     * @author ShiO
     */
    public function save() {
        $this->fileTream;
        return $this;
    }
}

class FileTream implements File {
    public $fileTream = null;

    /**
     * @author ShiO
     * FileTream constructor.
     * @param $tream
     */
    public function __construct($tream) {
        $this->fileTream = $tream;
    }

    /**
     * @author ShiO
     * @return null
     */
    public function read() {
        return $this->fileTream;
    }

    /**
     * @author ShiO
     * @param $path
     * 保存文件
     * @return LocalFile
     */
    public function save($path) {
        $local = new LocalFile($path);
        return $local->create();
    }

    /**
     * @author ShiO
     * @return null
     */
    public function getFileTream() {
        return $this->fileTream;
    }
}

class FilePersmission {
    const FileRead = 501;
    const FileWrite = 502;
    const FileDel = 502;
    private $authorizationArr = array();


    /**
     * @author ShiO
     * @param $permissionNum
     * @return $this
     * @throws FileReadPermissionException
     */
    public function need($permissionNum) {
        if ($this->have($permissionNum)) {
            return true;
        } else {
            // TODO::索求权限
            $result = false;
            if (!$result) {
                throw new FileReadPermissionException();
            } else {
                true;
            }
        }
    }

    /**
     * @author ShiO
     * @param $permissionNum
     * @return bool
     */
    private function have($permissionNum) {
        return in_array($permissionNum, $this->authorizationArr);
    }

    /**
     * @author ShiO
     * @param $permissionNum
     * @return mixed
     */
    public function check($permissionNum) {
        if ($this->have($permissionNum)) {
            return true;
        }
    }
}
