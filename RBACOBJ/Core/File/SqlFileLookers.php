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
        $this->fileObj->openFile(FILE::FILE_READ_MOD_OPEN);
    }
}