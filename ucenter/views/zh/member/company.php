<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/css/bootstrap.min.css') ?>

    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/css/register.css') ?>
</head>
<body>
<header>
    <!--logo-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-lg-5 visible-md visible-lg visible-sm visible-xs text-center">

                <a href=""><?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/logo/logo.png') ?></a>
            </div>
            <div class="col-md-7 col-lg-7 visible-md visible-lg
             text-center logo">
                <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/logo/logo-text.png') ?>
            </div>

        </div>

    </div>
</header>
<section>
    <div class="container">
        <div class="row registrationTitle text-center">

            <p id="pp"><span></span>注册成为菁蓉创业网会员</p>

        </div>

        <div class="row  text-center">
            <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/register/reg-step2.png') ?>
        </div>

    </div>

    <!--表单-->
    <div class="container" >
        <form action="company" method="post" class="detailsFrom">
            <input type="hidden" name="member_id" value="<?php echo $list['member_id']?>">
            <div class="abc" >
                <table>
                    <tr>
                        <td class="formTitle"><span class='requiredItem'>*</span>单位名称：</td>
                        <td><input name="name" class="required" placeholder="请输入单位名称" id="name" type="text" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle1"><span class='requiredItem'>*</span>联系人：</td>
                        <td><input name="link_name" id="link_name" placeholder="请输入联系人" type="text"  class="text04 required" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle"><span class='requiredItem'>*</span>手机号码：</td>
                        <td><input name="link_mobile" id="link_mobile" placeholder="请填写联系人手机号码" type="text"  class="text04 required" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle2"><span class='requiredItem'></span>联系人办公电话：</td>
                        <td class="formValue"><input name="link_tel" id="link_tel" placeholder="请输入联系人办公电话" type="text"  /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle3"><span class='requiredItem'></span>传真：</td>
                        <td class="formValue"><input name="link_fax" type="text"   /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle4"><span class='requiredItem'>*</span>企业负责人：</td>
                        <td class="formValue"><input name="co_name" id="co_name" placeholder="请输入企业负责人" type="text" class="required" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle"><span class='requiredItem'>*</span>手机号码：</td>
                        <td class="formValue"><input name="co_mobile" id="co_mobile" type="text"  class="text04 required" placeholder="请填写企业负责人手机号码" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle5">QQ：</td>
                        <td class="formValue"><input name="qq" placeholder="请输入QQ号" type="text"  class="text04" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">通讯地址：</td>
                        <td class="formValue"><input name="address" placeholder="请输入通讯地址" type="text"  class="text04" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">邮政编码：</td>
                        <td class="formValue"><input name="postal" placeholder="请输入邮编" type="text"  class="text04" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">注册资本：</td>
                        <td class="formValue"><input name="capital" placeholder="请输入注册资本，单位：万元" type="text"  class="text04" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">所属行业：</td>
                        <td class="formValue"><select name="industry_id"  class="text04">
                                <option value="">请选择</option>
                                <?php foreach ($bsdata as $data): ?>
                                    <option value='<?php echo "{$data['id']}" ?>'><?php echo "{$data['name']}"?></option>
                                <?php endforeach; ?>


                            </select></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle6">所属孵化器：</td>
                        <td class="formValue"><select name="incubator_id"  class="text04">
                                <option value="">请选择</option>
                                <?php foreach ($cbdata as $data): ?>
                                    <option value='<?php echo "{$data['id']}" ?>'>
                                        <?php echo "{$data['name']}"?></option>
                                <?php endforeach; ?>

                                <option value="其它单位">其它单位</option>

                            </select></td>
                    </tr>

                    <tr>
                        <th>
                        </th>
                        <td>

                            <input type="submit" name="" id="send" value="保存" onclick="return checkUserRegister();"  class="btn" />
                        </td>
                    </tr>
                </table>

            </div>
            <ul>
                <li class="regosterLiSolid"></li>
                <li class="regosterLiSolid2"></li>
                <li class="regosterLiSolid3"></li>
            </ul>

        </form>

    </div>


</section>
<footer>
    <div class="container-fluid ">
        <div class="registerFooterSolid"></div>
    </div>

    <div class="container registerFooter">
        <div class="row">
            <div class="col-md-1 col-xs-1 col-sm-1">
                <div class="centerBottom"></div>
                <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/footer/footer-logo1.png') ?>
            </div>
            <div class="col-md-11 col-xs-11 col-sm-11">
                <div class="col-md-11 col-sm-11 col-xs-11 text-center registerFooterP">
                    <p>菁蓉创新创业网 版权所有@2016 成都高新区创新创业服务中心 <a href="#">免责声明 </a> <a href="#">关于我们</a></p>
                    <p>地址：中国·成都 邮编：610041 网站备案号：蜀ICP备05009742号</p>
                </div>
                <div class="col-md-1 col-xs-1 col-sm-1">
                    <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/footer/footer-logo2.png') ?>
                </div>
            </div>

        </div>
    </div>
</footer>
<!--回到顶部-->
<div class="goto-top"></div>
<?=Html::jsFile(Yii::$app->params['asserts_url'].'ucenter/js/jquery-1.12.4.min.js') ?>
<?=Html::jsFile(Yii::$app->params['asserts_url'].'ucenter/js/register/register.js') ?>
<?=Html::jsFile(Yii::$app->params['asserts_url'].'ucenter/js/register/register_co_ser_incub.js') ?>
</body>
</html>


