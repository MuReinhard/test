<?php
namespace Model;
use Core\Service\SearchStrategy\SqlSearchClint;

/**
 * 角色与用户视图
 * @author ShiO
 * @date 2015年9月19日21:50:04
 */
class RbacPermissionModel extends Model implements DataModelInterface {
    /**
     * @author ShiO
     * @return mixed
     */
    public function build() {
        $search = new SqlSearchClint();
        $search->setBasisModel($this);
    }
}

?>