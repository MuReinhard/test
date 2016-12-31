<?php
/**
 * @author ShiO
 */

use Tree\Bean\OptionBean;
use Tree\Bean\QuestionBean;
use Tree\Bean\SurveyBean;
use Tree\TreeBranch;
use Tree\TreeItem;
use Tree\TreeManage;

$survey = new SurveyBean();
$survey->setSurveyId(1);
$survey->setSurveyName('问卷1');
$survey->setSurveyType(1);

$questionBean1 = new QuestionBean();
$questionBean1->setQuestionId(1);
$questionBean1->setQuestionName('问卷1-问题1');
$questionBean1->setQuestionType(1);
$questionBean1->setSurveyId(1);

$optionBean11 = new OptionBean();
$optionBean11->setOptionId(1);
$optionBean11->setOptionValue('问卷1-问题1-选项A');
$optionBean11->setOptionType(1);
$optionBean11->setOptionIsCorrect(true);
$optionBean11->setQuestionId(1);

$optionBean12 = new OptionBean();
$optionBean12->setOptionId(2);
$optionBean12->setOptionValue('问卷1-问题1-选项B');
$optionBean12->setOptionType(1);
$optionBean12->setOptionIsCorrect(true);
$optionBean12->setQuestionId(1);

$questionBean2 = new QuestionBean();
$questionBean2->setQuestionId(2);
$questionBean2->setQuestionName('问卷1-问题2');
$questionBean2->setQuestionType(1);
$questionBean2->setSurveyId(1);

$optionBean23 = new OptionBean();
$optionBean23->setOptionId(3);
$optionBean23->setOptionValue('问卷1-问题2-选项A');
$optionBean23->setOptionType(1);
$optionBean23->setOptionIsCorrect(true);
$optionBean23->setQuestionId(2);


$optionBean24 = new OptionBean();
$optionBean24->setOptionId(4);
$optionBean24->setOptionValue('问卷1-问题2-选项B');
$optionBean24->setOptionType(1);
$optionBean24->setOptionIsCorrect(true);
$optionBean24->setQuestionId(2);


$root = new TreeBranch($survey);
$b1 = new TreeBranch($questionBean1);
$b11 = new TreeItem($optionBean11);
$b12 = new TreeItem($optionBean12);

$b2 = new TreeBranch($questionBean2);
$b23 = new TreeItem($optionBean23);
$b24 = new TreeItem($optionBean24);

$root->add($b1);
$root->add($b2);

$b1->add($b11);
$b1->add($b12);

$b2->add($b23);
$b2->add($b24);


$manage = new TreeManage($root);

dump($manage->getQuestionById(1));

