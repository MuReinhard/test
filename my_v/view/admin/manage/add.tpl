<h2><a href="?a=manage">返回</a></h2>
<h2>添加管理员</h2>

<form action="?a=manage&m=add" method="post">
    <dl>
        <dd>用户名:<input type="text" name="user">2-20</dd>
        <dd>密码:<input type="password" name="pass">大于6</dd>
        <dd>确认密码：<input type="password" name="notpass"></dd>
        <dd>
            等级:<select name="level">
                    <option v="0" selected>请选择一个管理权限</option>
                    <option v="1">超级管理员</option>
                    <option v="2">普通管理员</option>
                    <option v="3">商品发布专员</option>
                    <option v="4">订单处理专员</option>
                </select>
        </dd>
        <dd><input type="submit" v="新增管理员" name="send"></dd>
    </dl>
</form>