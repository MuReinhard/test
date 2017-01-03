<?php
/**
 * @author ShiO
 */
// 全白创建场景
use Tree\Sueay\SueayTreeManage;
use Tree\TreeManage;

// 修改+创建场景
$data = array(
    array(
        'survey_id' => 1,
        'name' => '问卷',
        '_c' => array(
            array(
                'question_id' => 1,
                'name' => '问题1',
                'survey_id' => 1,
                '_c' => array(
                    array(
                        'option_id' => 1,
                        'name' => '选项11',
                        'question_id' => 1,
                    ),
                    array(
                        'option_id' => 2,
                        'name' => '选项12',
                        'question_id' => 1,
                    ),
                    array(
                        'name' => '选项13',
                        'question_id' => 1,
                    ),
                ),
            ),
            array(
                'question_id' => 2,
                'name' => '问题2',
                'survey_id' => 1,
                '_c' => array(
                    array(
                        'option_id' => 3,
                        'name' => '选项23',
                        'question_id' => 2,
                    ),
                    array(
                        'option_id' => 4,
                        'name' => '选项24',
                        'question_id' => 2,
                    ),
                ),
            ),
            array(
                'name' => '问题3',
                'survey_id' => 1,
            ),
        ),
    ),
);
$manage = new TreeManage();
$obj = $manage->crate($data);

$manage = new SueayTreeManage();
$manage->crate(array(),array(),array());
