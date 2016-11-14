<form action="edit" method="post">
    <input type="hidden" name="id" value="<?php echo "{$bs_data['id']}" ?>">
    用户名: <?php echo "{$bs_data['login_name']}" ?><br>
    昵称 :<?php echo "{$bs_data['nick_name']}" ?><br>
    类型 :<?php echo "{$bs_data['mtype']}" ?><br>
    邮箱:<?php echo "{$bs_data['email']}" ?><br>
    激活状态 : <?php echo "{$bs_data['email_status']}" ?><br>
    级别 : <?php echo "{$bs_data['email_status']}" ?><br>
    操作:<?php echo "{$bs_data['level']}" ?><br>
    <input type="submit" value="修改基本资料">
</form>



