<?php
namespace Model;
use ModelInf\RelationModelInf;

/**
 * @class PermissionGroupRelationModel
 * @author ShiO
 */
class PermissionGroupRelationModelModel extends Model implements RelationModelInf {
    public $p_p_g_relation_id;
    public $permission_id;
    public $permission_group_id;

    /**
     * @author ShiO
     * 绑定组成员对象
     * @param RbacPermissionModel $model
     * @param RbacPermissionGroupModel $bindModel
     * @return mixed
     */
    public function connect($model, $bindModel) {
        $this->permission_id = $model->getPk();
        $this->permission_group_id = $bindModel->getPk();
        return $this;
    }

    /**
     * @author ShiO
     * @return mixed
     */
    public function getPk() {
        return $this->p_p_g_relation_id;
    }

    /**
     * @author ShiO
     * @return $this
     */
    public function addData() {
        $table = array(
            'permission_group_relation' => 'permission_group_relation',
        );
        $data = array(
            'permission_id' => $this->permission_id,
            'permission_group_id' => $this->permission_group_id,
        );
        $id = $this->table($table)->data($data)->add();
        $this->setPk('p_p_g_relation_id', $id);
        return $this;
    }
}