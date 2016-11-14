<table border="1px">
    <tr>
        <td>ID</td>
        <td>用户名</td>
        <td>昵称</td>
        <td>类型</td>
        <td>邮箱</td>
        <td>激活状态</td>
        <td>级别</td>
        <td>联系人</td>
        <td>联系电话</td>
        <td>QQ</td>
        <td>操作</td>
    </tr>
    <tr>
        <td><?php echo "{$bs_data['id']}" ?></td>
        <td><?php echo "{$bs_data['login_name']}" ?></td>
        <td><?php echo "{$bs_data['nick_name']}" ?></td>
        <td><?php echo "{$bs_data['mtype']}" ?></td>
        <td><?php echo "{$bs_data['email']}" ?></td>
        <td><?php echo "{$bs_data['email_status']}" ?></td>
        <td><?php echo "{$bs_data['level']}" ?></td>
        <td><?php echo "{$bs_data_person['name']}" ?></td>
        <td><?php echo "{$bs_data_person['mobile']}" ?></td>
        <td><?php echo "{$bs_data_person['qq']}" ?></td>

        <td><a href="detail?id=<?php echo $bs_data['id'] ?>">修改资料</a></td>
    </tr>
</table>