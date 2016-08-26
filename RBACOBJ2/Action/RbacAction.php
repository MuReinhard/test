<?php
namespace Action;
use Model\UserModel;


/**
 * @class RbacAction
 * @author ShiO
 */
class RbacAction {
    /**
     * @author ShiO
     */
    public function index() {
        $model = new UserModel();
        $model->findData(1);
        dump($model->user_name);
    }
}