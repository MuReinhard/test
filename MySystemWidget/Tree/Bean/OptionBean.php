<?php
namespace Tree\Bean;
/**
 * @class OptionBean
 * @author ShiO
 */
class OptionBean {
    public $optionValue;
    public $optionId;
    public $optionType;
    public $optionIsCorrect;
    public $questionId;

    /**
     * @author ShiO
     * @return mixed
     */
    public function getOptionValue() {
        return $this->optionValue;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getOptionType() {
        return $this->optionType;
    }

    /**
     * @author ShiO
     * @param mixed $optionType
     */
    public function setOptionType($optionType) {
        $this->optionType = $optionType;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getOptionIsCorrect() {
        return $this->optionIsCorrect;
    }

    /**
     * @author ShiO
     * @param mixed $optionIsCorrect
     */
    public function setOptionIsCorrect($optionIsCorrect) {
        $this->optionIsCorrect = $optionIsCorrect;
    }

    /**
     * @author ShiO
     * @param mixed $optionValue
     */
    public function setOptionValue($optionValue) {
        $this->optionValue = $optionValue;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getOptionId() {
        return $this->optionId;
    }

    /**
     * @author ShiO
     * @param mixed $optionId
     */
    public function setOptionId($optionId) {
        $this->optionId = $optionId;
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
}