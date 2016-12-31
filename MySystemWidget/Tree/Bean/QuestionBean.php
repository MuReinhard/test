<?php
namespace Tree\Bean;
/**
 * @class QuestionBean
 * @author ShiO
 */
class QuestionBean {
    public $questionId;
    public $questionName;
    public $questionType;
    public $surveyId;

    /**
     * @author ShiO
     * @return mixed
     */
    public function getQuestionName() {
        return $this->questionName;
    }

    /**
     * @author ShiO
     * @param mixed $questionName
     */
    public function setQuestionName($questionName) {
        $this->questionName = $questionName;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getQuestionType() {
        return $this->questionType;
    }

    /**
     * @author ShiO
     * @param mixed $questionType
     */
    public function setQuestionType($questionType) {
        $this->questionType = $questionType;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getQuestionId() {
        return $this->questionId;
    }

    /**
     * @author ShiO
     * @param mixed $questionId
     */
    public function setQuestionId($questionId) {
        $this->questionId = $questionId;
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