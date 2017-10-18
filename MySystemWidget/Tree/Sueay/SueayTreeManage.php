<?php
namespace Tree\Sueay;

use Tree\TreeBranch;
use Tree\TreeManage;

/**
 * @class SuAdapter
 * @author ShiO
 */
class SueayTreeManage {
    public $adaptered;

    /**
     * @author ShiO
     * SueayManageAdapter constructor.
     */
    public function __construct() {
        $this->adaptered = new TreeManage();
    }

    /**
     * @author ShiO
     * @param $sueayData
     * @param $questionData
     * @param $optionData
     * @param string $questionIdField
     * @return TreeBranch
     */
    public function crate($sueayData, $questionData, $optionData, $questionIdField = 'question_id') {
        $questionArr = $this->adaptered->crateChildAndPrent($optionData, $questionData, $questionIdField);

        $sueayObj = new TreeBranch($sueayData[0]);
        foreach ($questionArr as $questionObj) {
            if ($questionObj instanceof TreeBranch) {
                $questionObj->setParent($sueayObj);
            } else {
                // 类型错误
            }
            $sueayObj->addChild($questionObj);
        }
        return $sueayObj;
    }
}