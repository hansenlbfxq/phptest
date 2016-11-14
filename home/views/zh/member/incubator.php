<!--孵化器页面-->
<form action="incubator" method="post">
    <input type="hidden" name="member_id" value="<?php echo $list['member_id']?>">
    孵化器名称：<input type="text" name="name"><br>
    联系人：<input type="text" name="link_name"><br>
    联系人手机：<input type="text" name="link_mobile"><br>
    联系人办公电话：<input type="text" name="link_tel"><br>
    联系传真：<input type="text" name="link_fax"><br>
    企业负责人：<input type="text" name="co_name"><br>
    企业负责人电话：<input type="text" name="co_mobile"><br>
    QQ：<input type="text" name="qq"><br>
    邮箱：<input type="text" name="postal"><br>
    注册资本：<input type="text" name="capital"><br>
    园区地址：<input type="text" name="garden_address"><br>
    园区面积：<input type="text" name="garden_area"><br>
    园区入住企业数：<input type="text" name="garden_cnum"><br>
    企业从业人员：<input type="text" name="work_num"><br>
    <input type="submit" value="保存">
</form>