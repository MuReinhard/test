<?php

/**
 * @class HttpImage
 * @author ShiO
 */
class HttpImage {
    private $url;
    public function __construct($url) {
        $this->url = $url;
    }

    /**
     * @author ShiO
     * @return string
     */
    public function get() {
        if (empty($this->url)) {
            return false;
        }
        $ext = strrchr($this->url, '.');
        if ($ext != '.gif' && $ext != ".jpg" && $ext != ".bmp" && $ext != ".png" && $ext != ".jpeg") {
            echo "格式不支持！";
            return false;
        }
        //开始捕捉
        ob_start();
        readfile($this->url);
        $img = ob_get_contents();
        ob_end_clean();
        return $img;
    }

}