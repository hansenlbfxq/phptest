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
                <a href="">  <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/logo/logo.png') ?></a>

            </div>
            <div class="col-md-7 col-lg-7 visible-md visible-lg
             text-center logo">
                <a href="">  <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/logo/logo-text.png') ?></a>

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
            <a href="">  <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/register/reg-step2.png') ?></a>

        </div>

    </div>

    <!--表单-->
    <div class="container" >
        <form action="incubator" method="post" class="detailsFrom">
            <input type="hidden" name="member_id" value="<?php echo $list['member_id']?>">
            <div class="abc" >
                <table>
                    <tr>
                        <td class="formTitle"><span class='requiredItem'>*</span>单位名称：</td>
                        <td><input name="name" placeholder="输入单位名称" id="name" class="required" type="text" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle1"><span class='requiredItem'>*</span>联系人：</td>
                        <td><input name="link_name" type="text" id="link_name" placeholder="联系人姓名" class="text04 required" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle"><span class='requiredItem'>*</span>手机号码：</td>
                        <td><input name="link_mobile" id="link_mobile" type="text" placeholder="请填写联系人手机号码" class="text04 required" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle2"><span class='requiredItem'>*</span>联系人办公电话：</td>
                        <td class="formValue"><input name="link_tel" id="link_tel" class="required" type="text" placeholder="请输入办公电话"  /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle3"><span class='requiredItem'>*</span>传真：</td>
                        <td class="formValue"><input name="link_fax" type="text" placeholder="请输入传真"   /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle4"><span class='requiredItem'>*</span>企业负责人：</td>
                        <td class="formValue"><input name="co_name" id="co_name" placeholder="企业负责人姓名" class="required" type="text" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle"><span class='requiredItem'>*</span>手机号码：</td>
                        <td class="formValue"><input name="co_mobile" id="co_mobile" type="text"  class="text04 required" placeholder="请填写企业负责人手机号码" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle5">QQ：</td>
                        <td class="formValue"><input name="qq" type="text"  class="text04" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">通讯地址：</td>
                        <td class="formValue"><input name="address" type="text" placeholder="请输入联系地址"  class="text04 required" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">邮政编码：</td>
                        <td class="formValue"><input name="postal" type="text" placeholder="请输入邮编"  class="text04" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">注册资本：</td>
                        <td class="formValue"><input name="capital" type="text"  class="text04 required" placeholder="输入注册资本，单位：万元" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">园区地址：</td>
                        <td class="formValue"><input name="garden_address" type="text"  class="text04 required" placeholder="请输入园区地址"/></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">园区面积：</td>
                        <td class="formValue"><input name="garden_area"  type="text" placeholder="请输入园区面积,单位：㎡" class="text04" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">入驻企业数：</td>
                        <td class="formValue"><input name="garden_cnum" type="text" placeholder="请输入园区入驻企业数"  class="text04" /></td>
                    </tr>
                    <tr style="display:;">
                        <td class="formTitle">企业从业人员：</td>
                        <td class="formValue"><input name="work_num" type="text" placeholder="请输入企业从业人员个数" class="text04" /></td>
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
                <a href="">  <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/footer/footer-logo1.png') ?></a>

            </div>
            <div class="col-md-11 col-xs-11 col-sm-11">
                <div class="col-md-11 col-sm-11 col-xs-11 text-center registerFooterP">
                    <p>菁蓉创新创业网 版权所有@2016 成都高新区创新创业服务中心 <a href="#">免责声明 </a> <a href="#">关于我们</a></p>
                    <p>地址：中国·成都 邮编：610041 网站备案号：蜀ICP备05009742号</p>
                </div>
                <div class="col-md-1 col-xs-1 col-sm-1">
                    <a href="">  <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/footer/footer-logo2.png') ?></a>
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
