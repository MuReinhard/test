<?php
/**
 * @author ShiO
 */
// 全白创建场景
use Tree\Model\SurveyModel;
use Tree\Sueay\SueayTreeManage;
use Tree\TreeBranch;
use Tree\TreeManage;

// 修改+创建场景
$sueayData = array(
    array(
        'survey_id' => 1,
        'name' => '问卷',
        'type' => 1,
    ),
);
$questionData = array(
    array(
        'question_id' => 1,
        'name' => '问题1',
        'survey_id' => 1,
        'type' => 2,
    ),
    array(
        'question_id' => 2,
        'name' => '问题2',
        'survey_id' => 1,
        'type' => 2,
    ),
);
$optionData = array(
    array(
        'option_id' => 1,
        'name' => '选项11',
        'question_id' => 1,
        'type' => 3,
    ),
    array(
        'option_id' => 2,
        'name' => '选项12',
        'question_id' => 1,
        'type' => 3,
    ),
    array(
        'option_id' => 3,
        'name' => '选项13',
        'question_id' => 1,
        'type' => 3,
    ),
    array(
        'option_id' => 3,
        'name' => '选项23',
        'question_id' => 2,
        'type' => 3,
    ),
    array(
        'option_id' => 4,
        'name' => '选项24',
        'question_id' => 2,
        'type' => 3,
    ),
);
//$manage = new TreeManage();
//$obj = $manage->crate($data);

$manage = new SueayTreeManage();
$obj = $manage->crate($sueayData, $questionData, $optionData);
//$obj->findBySelector(function (TreeBranch $item) {
//    $data = $item->getData();
//    if ($data['question_id'] == 1 and $data['type'] == 2) {
//        return true;
//    } else {
//        return false;
//    }
//})->remove();
//$arr = $obj->toArray();
//dump($arr);

$obj->findBySelector(function (TreeBranch $item) {
    $data = $item->data;
    if ($data['question_id'] == 1 && $data['type'] == 2) {
        return true;
    } else {
        return false;
    }
})->remove();
$arr = $obj->toArray();
dump($arr['_child']);

