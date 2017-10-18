<?php
namespace RBAC;

use RbacModelInf\RbacUserModelInf;

/**
 * @class RbacService
 * @author ShiO
 */
class RbacService {
    private $builder;
    private $result;

    /**
     * @author ShiO
     * Director constructor.
     * 建造工具对象的传入，以及启动建造流程
     * @param $builder
     */
    public function __construct(RbacBuilderInf $builder) {
        $this->builder = $builder;
    }

    /**
     * @author ShiO
     * 开始建造流程
     * @return $this
     */
    public function build() {
        $tree = $this->builder->userRoleToTree();
        $this->builder->userPermissionToTree();
        $this->result = $tree;
        return $this;
    }

    /**
     * @author ShiO
     */
    public function getResult() {
        $this->result;
    }
}