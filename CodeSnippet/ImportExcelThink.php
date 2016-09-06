<?php
/**
 * @author ShiO
 *
 */

/**
 * @author ShiO
 */
function importAwardsExcel() {
    $fieldFormatArr = array('shake_awards_coupon_name', 'shake_awards_coupon_detailed', array('date' => 'shake_awards_coupon_expiry_time'));

    //上传文件操作
    $upInfo = $this->upload('awards/excel', 20971520, $exts = array('xlsx', 'xls'));
    $filePath = './Public/Uploads/' . $upInfo[1]['thumb']['savepath'] . $upInfo[1]['thumb']['savename'];
    $fileExt = $upInfo[1]['thumb']['ext'];
    $service = new ShakeAwardsService();
    $this->readExcel($filePath, $fieldFormatArr, $fileExt, function ($fieldArr, $valueArr, ShakeAwardsService $service) use ($service) {
        $shakeAwardsId = I('get.shake_awards_id');
        $fieldArr[] = 'shake_awards_id';
        $valueArr[] = $shakeAwardsId;
        $data = array_combine($fieldArr, $valueArr);
        $data['shake_awards_coupon_expiry_time'] = strtotime($data['shake_awards_coupon_expiry_time']);
        return $service->addShakeAwardsCoupon($data);
    });
}


function readExcel($filePath, $fieldFormatArr, $fileExt, $handelFun) {
    import('Org.Util.PHPExcel.Classes.PHPExcel');

    import("Common.Org.PHPExcel");
    import("Common.Org.PHPExcel.Reader.Excel5");
    import("Common.Org.PHPExcel.IOFactory.php");
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
        $handelFlag = $handelFun($fieldArr, $valueArr);
    }
}
