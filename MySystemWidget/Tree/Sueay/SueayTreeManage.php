<?php
namespace Tree\Sueay;

use Closure;
use Exception;
use Tree\TreeBranch;
use Tree\TreeManage;
use TreeManageInf;

/**
 * @class SuAdapter
 * @author ShiO
 */
class SueayTreeManage implements TreeManageInf {
    public $adaptered;
    private $crateFun;

    /**
     * @author ShiO
     * SueayManageAdapter constructor.
     * @param Closure $createFun
     */
    public function __construct(Closure $createFun = null) {
        $this->crateFun = $createFun;
        $this->adaptered = new TreeManage($this->crateFun);
    }

    /**
     * @author ShiO
     * @param $sueayData
     * @param $questionData
     * @param $optionData
     * @return TreeBranch
     * @throws Exception
     */
    public function crateTree($sueayData, $questionData = null, $optionData = null) {
        if (!$sueayData || !$questionData || !$optionData) {
            throw new Exception();
            // 参数错误
        }
        $questionArr = $this->adaptered->crateChildAndPrent($optionData, $questionData, 'question_id');

        $sueayObj = new TreeBranch($sueayData[0], $this->crateFun);
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

    /**
     * @author ShiO
     * @param $data
     * @return mixed
     */
    public function crateItem($data) {
        $itemObj = new TreeBranch($data, $this->crateFun);
        return $itemObj;
    }
}