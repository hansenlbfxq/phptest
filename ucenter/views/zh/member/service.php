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
        <form action="service" method="post" class="detailsFrom">
            <input type="hidden" name="member_id" value="<?php echo $list['member_id']?>">
            <div class="abc" >
                <table>

                    <tr>
                        <td class="formTitle1"><span class='requiredItem'>*</span>单位名称：</td>
                        <td><input name="name" id="name" placeholder="请输入单位名称" type="text"  class="text04 required" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle1"><span class='requiredItem'>*</span>主要负责人：</td>
                        <td><input name="link_name" id="link_name" placeholder="请输入负责人姓名" type="text"  class="text04 required" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle1"><span class='requiredItem'>*</span>手机号码：</td>
                        <td><input name="link_mobile" id="link_mobile" placeholder="请输入联系人手机号" type="text"  class="text04 required" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle1"><span class='requiredItem'></span>办公电话：</td>
                        <td><input name="link_tel" id="link_tel" type="text" placeholder="请输入办公电话"  class="text04 required" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle1"><span class='requiredItem'>*</span>联系人：</td>
                        <td><input name="co_name" id="co_name" type="text" placeholder="请输入联系姓名"  class="text04 required" /></td>
                    </tr>
                    <tr>
                        <td class="formTitle1"><span class='requiredItem'>*</span>联系电话：</td>
                        <td><input name="co_mobile" id="co_mobile" type="text" placeholder="请输入联系人手机号"  class="text04 required" /></td>
                    </tr>

                    <tr>
                        <td class="formTitle1"><span class='requiredItem'></span>联系办公电话：</td>
                        <td><input name="co_tel" id="co_tel" type="text" placeholder="请输入联系联系办公电话"  class="text04 required" /></td>
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

