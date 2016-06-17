<?php
namespace Core\File;
use Exception\FileReadException;

/**
 * @class File
 * @author ShiO
 */
class File {
    public $filePath;
    public $file;
    public $fileData;

    const FILE_READ_MOD_OPEN = 1;

    /**
     * @author ShiO
     * File constructor.
     * @param $file
     */
    public function __construct($file) {
        if ($file instanceof File) {
            $this->file = $file;
        } else {
            $this->filePath = $file;
        }
    }

    /**
     * @author ShiO
     * @param $mod
     * @return resource
     * @throws FileReadException
     */
    public function openFile($mod) {
        $this->fileData = fopen($this->filePath,$mod);
        if ($this->fileData) {
            throw new FileReadException();
        }
    }
}