<?php

/**
 * @class LocalFile
 * @author ShiO
 */
class FileTool {
    public $filePath;
    public $fileName;
    private $fileExt;
    // 文件指针
    public $filePoint;

    /**
     * @author ShiO
     * @return mixed
     */
    public function getFilePath() {
        return $this->filePath;
    }

    public function __construct($path) {
        $this->pathAnalysis($path);
    }

    /**
     * @author ShiO
     * @return FileTool
     * @throws Exception
     */
    public function read() {
        if (!$this->checkFileExist()) {
            throw new Exception('文件不存在');
        }
        $class = new FilePermission();
        $pass = false;
        if (!$class->check(FilePermission::FileRead)) {
            if ($class->need(FilePermission::FileRead)) {
                // 读取文件
                $pass = true;
            }
        } else {
            $pass = true;
        }
        if ($pass) {
            if ($this->filePoint) {
                return $this;
            } else {
                $this->filePoint = fopen($this->filePath, 'r');
            }
        }
        return $this;
    }

    /**
     * @author ShiO
     * @param $path
     */
    private function pathAnalysis($path) {
        $arr = pathinfo($path);
        $this->filePath = $path;
        $this->fileName = $arr['basename'];
        $this->fileExt = $arr['extension'];
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
     * @param $data
     * @return $this
     * @throws Exception
     */
    public function writer($data) {
        $class = new FilePermission();
        $pass = false;
        if (!$class->check(FilePermission::FileWrite)) {
            if ($class->need(FilePermission::FileWrite)) {
                $pass = true;
            }
        } else {
            $pass = true;
        }
        if ($pass) {
            // 写入文件
            fwrite($this->filePoint, $data);
        }
        return $this;
    }

    /**
     * @author ShiO
     * 创造文件
     * @param $data
     * @return FileTool
     * @throws Exception
     */
    public function create($data = null) {
        $class = new FilePermission();
        $pass = false;
        if (!$class->check(FilePermission::FileWrite)) {
            if ($class->need(FilePermission::FileWrite)) {
                $pass = true;
            }
        } else {
            $pass = true;
        }
        if ($pass) {
            $this->filePoint = fopen($this->filePath, 'w');
            if ($data) {
                $this->writer($data);
            }
        }
        return $this;
    }

    /**
     * @author ShiO
     */
    public function save() {
        return $this;
    }

    /**
     * @author ShiO
     */
    public function close() {
        fclose($this->filePoint);
    }
}
