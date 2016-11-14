<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/register/css/bootstrap.min.css') ?>
    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/register/css/bootstrap-theme.min.css') ?>
    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/register/css/register.css') ?>
    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/register/css/bootstrap.css') ?>
</head>
<body>
<header>
    <!--logo-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-lg-5 visible-md visible-lg visible-sm visible-xs text-center">

                <a href=""> <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/register/images/logo/logo.png') ?></a>
            </div>
            <div class="col-md-7 col-lg-7 visible-md visible-lg
             text-center logo">
                <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/register/images/logo/logo-text.png') ?>
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
            <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/register/images/register/reg-step3.png') ?>

        </div>

    </div>
    <div style="width: 620px; margin:0 auto">
        <div class="emailVerificatuon" style="padding: 80px 0 100px 0;text-indent: 40px">

            尊敬的用户，你已经激活邮箱，<a href="login">请点击到登录页面</a>
            <div>
                <ul>
                    <li class="regosterLiSolid"></li>
                    <li class="regosterLiSolid2"></li>
                    <li class="regosterLiSolid3"></li>
                </ul>
            </div>

        </div>



    </div>
</section>
<footer>
    <div class="container-fluid ">
        <div class="registerFooterSolid"></div>
    </div>

    <div class="container registerFooter">
        <div class="row" style="width: 660px ;position: absolute;left: 50%;margin-left: -320px">
            <div class="col-md-1 col-xs-1 col-sm-1">
                <div class="centerBottom"></div>
                <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/register/images/footer/footer-logo1.png') ?>

            </div>
            <div class="col-md-11 col-xs-11 col-sm-11">
                <div class="col-md-10 col-sm-10 col-xs-10 text-center registerFooterP">
                    <p>菁蓉创新创业网 版权所有@2016 成都高新区创新创业服务中心 <a href="#">免责声明 </a> <a href="#">关于我们</a></p>
                    <p>地址：中国·成都 邮编：610041 网站备案号：蜀ICP备05009742号</p>
                </div>
                <div class="col-md-1 col-xs-1 col-sm-1 pullleft">
                    <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/register/images/footer/footer-logo2.png') ?>

                </div>
            </div>

        </div>
    </div>
</footer>
<!--回到顶部-->
<div class="goto-top"></div>
<?=Html::jsFile(Yii::$app->params['asserts_url'].'ucenter/register/js/jquery-1.11.2.js') ?>
<?=Html::jsFile(Yii::$app->params['asserts_url'].'ucenter/register/js/register/register.js') ?>

</body>
</html>