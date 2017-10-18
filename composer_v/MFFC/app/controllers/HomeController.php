<?php
use Zizaco\Entrust\EntrustPermission;
use Zizaco\Entrust\EntrustRole;

/**
 * @author ShiO
 */
class HomeController extends BaseController {
    public function home() {
        $admin = new EntrustRole();
        $admin->name = 'Admin';
        $admin->save();

        $owner = new EntrustRole();
        $owner->name         = 'owner';
        $owner->display_name = 'Project Owner'; // optional
        $owner->description  = 'User is the owner of a given project'; // optional
        $owner->save();

        $manageUsers = new EntrustPermission();
        $manageUsers->name = 'manage_users';
        $manageUsers->display_name = 'Manage Users';
        $manageUsers->save();

        $managePosts = new EntrustPermission;
        $managePosts->name = 'manage_posts';
        $managePosts->display_name = 'Manage Posts';
        $managePosts->save();

        $owner->perms()->sync(array($managePosts->id, $manageUsers->id));
        $admin->perms()->sync(array($managePosts->id));

        // 获取用户
//        $user = User::where('username','=','Zizaco')->first();

        // 可以使用 Entrust 提供的便捷方法用户授权
        // 注: 参数可以为 Role 对象, 数组, 或者 ID
        $user->attachRole( $admin );

        // 或者使用 Eloquent 自带的对象关系赋值
        $user->roles()->attach( $admin->id ); // id only
    }
}