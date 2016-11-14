<!--个人页面-->
<form action="person" method="post">
    <input type="hidden" name="member_id" value="<?php echo $list['member_id']?>">
    姓名：<input type="text" name="name" ></br>
    手机：<input type="text" name="mobile"></br>
    QQ：<input type="text" name="qq"></br>
    <input type="submit" value="保存">
</form>