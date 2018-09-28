<?php

class ExcelTool
{
    /**
     * @author ShiO Gong
     * @param $filePath
     * @param $fieldFormatArr
     * @param $fileExt
     * @param $handelFun
     */
    function readExcel($filePath, $fieldFormatArr, $fileExt, $handelFun)
    {
        if ($fileExt == 'xlsx') {
            $fileType = 'Excel2007';
        } else {
            $fileType = 'Excel5';
        }
        $objReader = \PHPExcel_IOFactory::createReader($fileType); //使用excel2007 版的格式来格式化excel数据
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', '10000');
        $objPHPExcel = $objReader->load($filePath);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数

        $fieldArr = $fieldFormatArr;
        // 创造行标数组
        $listKey = range('A', 'Z');
        // 循环以总条数开始循环
        for ($j = 2; $j <= $highestRow; $j++) {
            $valueArr = array();
            // 循环字段格式数组
            foreach ($fieldFormatArr as $key => $value) {
                // 如果发现有特殊格式，处理特殊格式数据
                if (is_array($value)) {
                    $handelKey = key($value);
                    switch ($handelKey) {
                        case 'date':
                            $valueArr[] = gmdate('Y-m-d H:i:s', \PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell($listKey[$key] . $j)->getValue()));
                            break;
                    }
                    // 复原字段数组应有的姿势
                    $fieldArr[$key] = $value[$handelKey];
                } else {
                    // 没有特殊格式，处理数据
                    $valueArr[] = $objPHPExcel->getActiveSheet()->getCell($listKey[$key] . $j)->getValue();
                }
            }
            // 交给匿名函数处理两个数组
            $handelFlag = $handelFun($fieldArr, $valueArr, $j);
        }
    }

    /**
     * @author ShiO Gong
     */
    function explodeCST($data)
    {
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


}
