<?php
/**
 * @author ShiO
 */
function ExplodCSV() {
    $thArr = array('昵称', '手机号');
    $thArr = implode(',', $thArr) . "\n";
    $tdArr = null;
    for ($i = 0; $i < count($data); $i++) {
        $tdArr .= $data[$i]['name']
            . ',' . $data[$i]['mobile']
            . "\n";
    }
    $file_name = '问卷正确名单_' . date('Y-m-d') . '.csv';
    header("Content-type:text/csv");
    header("Content-Disposition:attachment;filename=" . $file_name);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    $str = $thArr . $tdArr;
    echo chr(0xEF) . chr(0xBB) . chr(0xBF);
    echo $str;
    die();
}
