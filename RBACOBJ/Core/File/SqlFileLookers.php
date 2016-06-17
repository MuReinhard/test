<?php
namespace Core\File;
/**
 * @class SqlFileLookers
 * @author ShiO
 */
class SqlFileLookers {
    public $fileObj;

    public function __construct(File $fileObj) {
        $this->fileObj = $fileObj;
    }

    /**
     * @author ShiO
     */
    public function getData() {
        return '我是sql语句';
//        return $this->fileObj->openFile(FILE::FILE_READ_MOD_OPEN);
    }
}