<!--服务机构页面-->
<form action="service" method="post">
    <input type="hidden" name="member_id" value="<?php echo $list['member_id']?>">
    单位名称：<input type="text" name="name"><br>
    联系人：<input type="text" name="link_name"><br>
    联系人电话（手机号）：<input type="text" name="link_mobile"><br>
    联系人办公电话（手机号）：<input type="text" name="link_tel"><br>
    负责人：<input type="text" name="co_name"><br>
    负责人手机：<input type="text" name="co_mobile"><br>
    负责人办公电话：<input type="text" name="co_tel"><br>
    <input type="submit" value="保存"><br>
</form>