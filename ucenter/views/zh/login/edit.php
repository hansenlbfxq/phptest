<form action="update" method="post">
    昵称：<input type="text" disabled="disabled" name="nick_name" value="<?php echo $list['nick_name'] ?>"><br>
    邮件：<input type="text" name="email" value="<?php echo $list['email'] ?>">
    <input type="hidden" name="id" value="<?php echo $list['id'] ?>">
    <input type="submit" value="修改">
</form>