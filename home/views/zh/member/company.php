<!--创新企业页面-->
<form action="company" method="post">

    用户关联ID：<input type="text" name="member_id" value="<?php echo $list['member_id']?>"><br>
    行业信息：<select name="industry_id" >
        <?php foreach ($bsdata as $data): ?>
        <option value='<?php echo "{$data['id']}" ?>'><?php echo "{$data['name']}"?></option>
       <?php endforeach; ?>
    </select><br>
    孵化器ID：<select name="incubator_id" >
        <?php foreach ($cbdata as $data): ?>
            <option value='<?php echo "{$data['id']}" ?>'>
                <?php echo "{$data['name']}"?></option>
        <?php endforeach; ?>
    </select><br>
<!--    用 隐藏域传过去-->
<!--    孵化器会员ID：<input type="text" name="incubator_member_id"><br>-->


    单位名称：<input type="text" name="name"><br>
    联系人：<input type="text" name="link_name"><br>
    联系人手机：<input type="text" name="link_mobile"><br>
    联系人办公电话：<input type="text" name="link_tel"><br>
    联系人传真：<input type="text" name="link_fax"><br>
    企业负责人：<input type="text" name="co_name"><br>
    企业负责人电话：<input type="text" name="co_mobile"><br>
    QQ：<input type="text" name="qq"><br>
    通讯地址：<input type="text" name="address"><br>
    邮编：<input type="text" name="postal"><br>
    <input type="submit" value="保存">
</form>