<?php
/**
 * @author ShiO
 */
//$upload = new upload();
//$upload->saveImg();

//$request = new SystemRequest();
//dump($_REQUEST);
//$request->getRequest('');
$re = new \Upload\Tool\UploadFileUtil();
$re->upload('uploadSite/');
echo '1';


class upload {
    /**
     * @author ShiO
     * @param int $max
     */
    public function saveImg($max = 2000000) {
        if ((($_FILES["file"]["type"] == "image/gif")
                || ($_FILES["file"]["type"] == "image/jpeg")
                || ($_FILES["file"]["type"] == "image/pjpeg"))
            && ($_FILES["file"]["size"] < $max)
        ) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            } else {
                echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                echo "Type: " . $_FILES["file"]["type"] . "<br />";
                echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

                if (file_exists("upload/" . $_FILES["file"]["name"])) {
                    echo $_FILES["file"]["name"] . " already exists. ";
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                        "upload/" . $_FILES["file"]["name"]);
                    echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                }
            }
        } else {
            echo "Invalid file";
        }
    }

    /**
     * @author ShiO
     */
    public function getRange() {
    }
}
class SystemRequest{
    /**
     * @author ShiO
     * @param $name
     * @return mixed
     */
    public function getRequest($name) {
        return $_REQUEST[$name];
    }

}
