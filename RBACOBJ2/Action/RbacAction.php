<?php
namespace Action;

use Model\GroupModelInf;
use Model\RbacPermissionModel;
use Model\RbacRoleModel;
use Model\RbacUserInf;
use Model\UserGroupModel;
use Model\UserGroupRelationModel;
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
        $userModel = new UserModel();
        $userModel = $userModel->findData()->saveToDB();

        $userGroupModel = new UserGroupModel();
        $userGroupModel = $userGroupModel->findData();



        $roleModel = new RbacRoleModel();
        $roleModel->setName('管理员');
        $roleModel->saveToDB();

        $permissionModel = new RbacPermissionModel();
        $permissionModel->setName('管理员权限');
        $permissionModel->saveToDB();

        $userGroupRelationModel = new UserGroupRelationModel();
        $userGroupRelationModel->connect($userModel, $userGroupModel)->saveToDB();

    }
}