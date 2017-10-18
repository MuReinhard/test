<?php
namespace RBAC;

use Model\PermissionModel;
use Model\RoleModel;
use RbacModelInf\RbacUserModelInf;

/**
 * @class RbacBuilder
 * @author ShiO
 */
class RbacUserDataBeanBuilder implements RbacBuilderInf {
    private $tree;

    public function __construct(RbacUserModelInf $userModel) {
        $this->tree = new Tree($userModel);
    }

    /**
     * @author ShiO
     * 用户所有权限
     * @return mixed
     */
    public function userPermissionToTree() {
        $data = $this->tree->getInstance()->getUserAllPermission();
        foreach ($data as $key => $value) {
            $permissionModel = new PermissionModel();
            $permissionModel->modelBean($data[$key]);
            $this->tree->getBranch()->getInstance()->findIndexByValue($permissionModel->getPk(),$permissionModel->getPk())->setPermissionModel($permissionModel);
        }
        return $this;
    }

    /**
     * @author ShiO
     * 用户所有的角色
     * @return mixed
     */
    public function userRoleToTree() {
        $data = $this->tree->getInstance()->getUserAllRole();
        foreach ($data as $key => $value) {
            $roleModel = new RoleModel();
            $roleModel->modelBean($data[$key]);
            $this->tree->add(new Branch($roleModel));
        }
        return $this;
    }

    /**
     * @author ShiO
     * @param $tree
     */
    public function setTree($tree) {
        $this->tree = $tree;
    }

    /**
     * @author ShiO
     * @return Tree
     */
    public function getTree() {
        return $this->tree;
    }
}