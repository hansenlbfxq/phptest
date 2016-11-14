<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/css/bootstrap.min.css') ?>

    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/css/login/login.css') ?>
</head>
<body>
<header>
    <!--logo-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 col-lg-5 visible-md visible-lg visible-sm visible-xs text-center">
                <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/logo/logo.png') ?>

            </div>
            <div class="col-md-7 col-lg-7 visible-md visible-lg
             text-center logo">
                <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/logo/logo-text.png') ?>
            </div>

        </div>

    </div>
</header>

<!--表单-->
<section>
    <div class="container memberRegistrationFrom">
        <div class="row text-center">
            <div class="col-md-12 col-xs-12 col-sm-12 te memberBacjground">会员登陆</div>
        </div>

        <!--表单-->
        <div class="row memberRegistrationFrom1">
            <div class="col-md-12 col-xs-12 col-sm-12 ">
                <form action="login" method="post">
                    <table class="memberLoginForm">
                        <tr>
                            <td class="membertext">用户名:</td>
                            <td >
                                <div class="backgroundimg1"></div>
                            </td>
                            <td><input type="text" placeholder=" 请输入用户名" name="login_name" class="login_name" >

                            </td>
                        </tr>
                        <tr>
                            <td class="membertext">密码:</td>
                            <td >
                                <div class="backgroundimg2"></div>
                            </td>
                            <td><input type="password"  name="pwd" class="pwd" >
                               </td>
                        </tr>
                        <tr >
                            <td style="display: none" class="tishi"></td>
                        </tr>
                        <tr>
                            <td class="memberButton">
                                <div>
                                    <input  type="submit" class="login" id="send" value="登录">
                                    <span>忘记密码？</span>
                                    <p>
                                        <span class="spancolor">>></span>
                                        不是会员？<a href="/member/register">立即注册</a> </p>
                                </div>
                            </td>
                        </tr>
                    </table>

                </form>
            </div>
        </div>
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
</body>
</html>
<script type="text/javascript">
//    $(function(){
//        $("form :input.required").each(function(){
//            var $required = $("<strong class='high'> </strong>"); //创建元素
//            $(this).parent().append($required); //然后将它追加到文档中
//        });
//        //文本框失去焦点后
//        $('form :input').blur(function(){
//            var $parent = $(this).parent();
//            $parent.find(".formtips").remove();
//            //验证单位名称
//            if( $(this).is('.login_name') ){
//                if( this.value==""){
//                    var errorMsg = '啊啊大';
//                    $parent.append('<span style="color:red ;" class="formtips onError">'+errorMsg+'</span>');
//                } else {
//                    var okMsg = '';
//                    $parent.append('<span class="formtips onSuccess">'+okMsg+'</span>');
//                }
//            }
//
//
//        }).keyup(function(){
//            $(this).triggerHandler("blur");
//        }).focus(function(){
//            $(this).triggerHandler("blur");
//        });//end blur
//
//        //提交，最终验证。
//        $('#send').click(function(){
//            $("form :input.required").trigger('blur');
//            var numError = $('form .onError').length;
//            if(numError ){
//                return false;
//            }
//
////           alert("注册成功,激活正在邮件已发送，请查收");
//        });
//    })
</script>