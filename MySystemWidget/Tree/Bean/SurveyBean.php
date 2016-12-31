<?php
namespace Tree\Bean;
/**
 * @class SurveyBean
 * @author ShiO
 */
class SurveyBean {
    public $surveyId;
    public $surveyName;
    public $surveyType;

    /**
     * @author ShiO
     * @return mixed
     */
    public function getSurveyName() {
        return $this->surveyName;
    }

    /**
     * @author ShiO
     * @param mixed $surveyName
     */
    public function setSurveyName($surveyName) {
        $this->surveyName = $surveyName;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getSurveyType() {
        return $this->surveyType;
    }

    /**
     * @author ShiO
     * @param mixed $surveyType
     */
    public function setSurveyType($surveyType) {
        $this->surveyType = $surveyType;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getSurveyId() {
        return $this->surveyId;
    }

    /**
     * @author ShiO
     * @param mixed $surveyId
     */
    public function setSurveyId($surveyId) {
        $this->surveyId = $surveyId;
    }
}