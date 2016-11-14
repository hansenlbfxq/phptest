<form action="edit_pwd" method="post">

    用户名：<input type="text" disabled="disabled" value="<?php echo $list['login_name']?>"><br>
    原始密码：<input type="password" name="old_pwd"><br />
    请输入新密码：<input type="password" name="pwd1"><br/>
    确认新密码：<input type="password" name="pwd2"><br>
    <input type="hidden" name="id" value="<?php echo $list['id']?>">
    <input type="submit" value="确认修改">
</form>