<?php
/**
 * @author ShiO
 */
// 全白创建场景
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
$data = array(
    array(
        'id' => 1,
        'name' => '问卷',
        'pid' => 0,
    ),
    array(
        'id' => 21,
        'name' => '题目1',
        'pid' => 1,
    ),
    array(
        'id' => 3,
        'name' => '题目2',
        'pid' => 1,
    ),
    array(
        'id' => 4,
        'name' => '1选项A',
        'pid' => 21,
    ),
    array(
        'id' => 5,
        'name' => '1选项B',
        'pid' => 21,
    ),
    array(
        'id' => 6,
        'name' => '2选项A',
        'pid' => 3,
    ),
    array(
        'id' => 7,
        'name' => '2选项B',
        'pid' => 3,
    ),
    array(
        'id' => 8,
        'name' => '2选项C',
        'pid' => 3,
    ),
    array(
        'id' => 9,
        'name' => 'hi',
        'pid' => 8,
    ),
);
$manage = new TreeManage(function (TreeBranch $item) {
    $data = $item->data;
    // 新增每个节点到数据库
    switch ($data['type']) {
        case 1:
            break;
        case 2:
            break;
        case 3:
            break;
    }
});
$data = $manage->crateTree($data);
dump($data->toArray());

$manage = new SueayTreeManage(function (TreeBranch $item) {
    $data = $item->data;
    // 新增每个节点到数据库
    switch ($data['type']) {
        case 1:
            break;
        case 2:
            break;
        case 3:
            break;
    }

});
$obj = $manage->crateTree($sueayData, $questionData, $optionData);
$obj->findBySelector(function (TreeBranch $item) {
    $data = $item->getData();
    if ($data['question_id'] == 1 and $data['type'] == 2) {
        return true;
    } else {
        return false;
    }
})->remove();
$arr = $obj->toArray();
dump($arr);

$obj->findBySelector(function (TreeBranch $item) {
    $data = $item->data;
    if (isset($data['question_id']) && $data['question_id'] == 1 && $data['type'] == 2) {
        return true;
    } else {
        return false;
    }
})->remove(function (TreeBranch $item) {
    $data = $item->data;
    switch ($data['type']) {
        case 1:
            echo '您删除了问卷：';
            echo $data['sueay_id'];
            echo '<br/>';
            break;
        case 2:
            echo '您删除了问题：';
            echo $data['question_id'];
            echo '<br/>';
            break;
        case 3:
            echo '您删除了选项：';
            echo $data['option_id'];
            echo '<br/>';
            break;
    }
});
$arr = $obj->toArray();
dump($arr['_child']);

