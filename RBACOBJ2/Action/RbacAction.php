<?php
namespace Action;

use Model\UserModel;
use RBAC\RbacService;
use RBAC\RbacUserDataBeanBuilder;


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

        $builder = new RbacUserDataBeanBuilder($model);
        $service = new RbacService($builder);
        $service->build()->getResult();
    }
}