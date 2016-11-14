<?php
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="name" content="成都创新中心.">
    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/css/bootstrap.min.css') ?>

    <?=Html::cssFile(Yii::$app->params['asserts_url'].'ucenter/css/register.css') ?>

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
<section>
    <div class="container">
        <div class="row registrationTitle text-center">

            <p id="pp"><span></span>注册成为菁蓉创业网会员</p>

        </div>

        <div class="row  text-center">
            <?=Html::img(Yii::$app->params['asserts_url'].'ucenter/images/register/reg-step1.png') ?>

        </div>

    </div>
    <div class="titlebackground">
        <div class="row formtitle" >
            <form class="form-horizontal" role="form" method="post" action="register">

                <div class="registerForm">
                    <table class="registerTable1">
                        <tr>
                            <td ><span class=" asterisk" >*</span>用户类型：</td>
                            <td><input type="radio" checked="checked" name="mtype" id="inlineRadio1" value="1" > 创业企业</td>
                            <td><input type="radio" name="mtype" id="inlineRadio2" value="2">孵化器</td>
                            <td><input type="radio" name="mtype" id="inlineRadio3" value="3"> 服务机构</td>
                            <td><input type="radio" name="mtype" id="inlineRadio4" value="4"> 个人</td>
                        </tr>
                    </table>



                    <table class="registerTable">
                        <tr>
                            <td class="text1"><span class=" asterisk ">*</span>用户名：</td>
                            <td class="registertd"><input type="text" name="login_name" class="required" id="username"><span style="color: red" class="user_only"></span></td>
                        </tr>
                        <tr>

                            <td class="text2" ><span class=" asterisk">*</span>密码：</td>
                            <td class="registertd"><input  type="password" name="pwd" class="required" id="password" ></td>
                        </tr>
                        <tr>
                            <td class="text3" ><span class=" asterisk">*</span>确认密码：</td>
                            <td class="registertd"><input type="password" name="pwdAffirm" class="required " id="repwd" ></td>
                        </tr>
                        <tr>
                            <td class="text4"><span class=" asterisk">*</span>Email地址：</td>
                            <td class="registertd"><input type="email" name="email" class="required" id="email"><span style="color: red" class="email_only"></span></td>
                        </tr>
                        <tr>
                            <td class="text5">
                                <span class=" asterisk">*</span>
                            </td>
                            <td class="text6">
                                <input type="checkbox" name="acceptAgreement" class="checkbox" id="agreement" style="float:left;" value="1"><span style="color:red ;" class="fffff"></span>
                                <span>接受网站《服务协议》</span>
                                <span class="acceptAgreement" onclick="showAndHideDiv(&quot;fwxy&quot;)">查看《服务协议书》</span></td>
                        </tr>
                    </table>

                </div>

                <div id="fwxy">
                     <textarea>菁蓉创新创业网用户协议:

1. 特别提示
1.1 成都高新区技术创新服务中心（以下称“创新中心”）同意按照本协议的规定及其不时发布的操作规则提供基于互联网的相关服务（以下称 " 网络服务 " ），为获得网络服务，服务使用人（以下称 " 用户 " ）应当同意本协议的全部条款并按照页面上的提示完成全部的注册程序。用户在进行注册程序过程中点击 "接受网站《服务协议》 " 按钮即表示用户完全接受本协议项下的全部条款。
2. 服务内容
2.1 菁蓉创新创业网由创新中心创办，其项下的权利和义务全部由创新中心享有和承担，其服务的具体内容由创新中心根据实际情况提供，例如发布信息、在线交流等。创新中心保留随时变更、中断或终止部分或全部网络服务的权利。
2.2 菁蓉创新创业网仅提供相关的网络服务，而与网络服务有关的设施设备，包括但不限于电脑、手机或其他接入装置，以及为接受相关网络服务而需支付的费用，包括但不限于电话费、上网费、手机费等，均由用户自行负担。
3. 使用规则
3.1 用户在申请使用菁蓉创新创业网的免费资源时，必须向创新中心提供准确的个人资料，如个人资料有任何变动，必须及时更新。
3.2 用户注册成功后，菁蓉创新创业网将给予每个用户一个用户帐号及相应的密码，该用户帐号和密码由用户负责保管；用户应当对其使用的用户帐号进行的所有活动和事件负法律责任。因用户自身原因或黑客等第三方行为导致其账号和密码被他人非法使用的，菁蓉创新创业网对此不承担任何责任。
3.3 用户同意接受创新中心通过电子邮件或其他方式向用户发送的通知信息或其他相关的企业服务信息。
3.4 用户在使用菁蓉创新创业网服务过程中，必须遵循以下原则：
(a) 遵守中国有关的法律和法规；
(b) 不得为任何非法目的而使用网络服务系统；
(c) 遵守所有与网络服务有关的网络协议、规定和程序；
(d) 不得利用菁蓉创新创业网系统进行任何可能对互联网的正常运转造成不利影响的行为；
(e) 不得利用菁蓉创新创业网系统传输任何虚假的、骚扰性的、中伤他人的、辱骂性的、恐吓性的、庸俗淫秽的或其他任何非法的信息资料；
(f) 不得利用菁蓉创新创业网系统进行任何不利于菁蓉创新创业网的行为；
(g) 不得利用菁蓉创新创业网系统侵犯任何第三方的名誉权、著作权、专利权及其他任何合法权益；
(h) 如发现任何非法使用用户帐号或帐号出现安全漏洞的情况，应立即通告创新中心。
4. 内容所有权
4.1 菁蓉创新创业网提供的网络服务内容可能包括：企业信息、文字、软件、声音、图片、录象、图表等。所有这些内容受版权、商标和其它财产所有权法律的保护。
4.2 用户只有在获得创新中心或其他相关权利人的授权之后才能使用这些内容，而不得擅自复制、再造这些内容、或创造与内容有关的派生产品。
5. 隐私保护
5.1 保护用户隐私是菁蓉创新创业网的一项基本政策，菁蓉创新创业网保证不对外公开或向第三方提供用户注册资料及用户在使用网络服务时存储在菁蓉创新创业网的非公开内容，但下列情况除外：
(a) 事先获得用户的明确授权；
(b) 根据有关的法律法规要求；
(c) 按照相关政府主管部门的要求；
(d) 为维护社会公众利益；
(e) 为维护菁蓉创新创业网的合法权益。
5.2 菁蓉创新创业网可能会与第三方合作向用户提供相关的网络服务，在此情况下，如该第三方同意承担与菁蓉创新创业网同等的保护用户隐私的责任，则菁蓉创新创业网有权将用户的注册资料等提供给该第三方。
5.3 在不透露单个用户隐私资料的前提下，创新中心有权对整个用户数据库进行分析、利用、处理。
6. 免责声明
6.1 用户明确同意其使用菁蓉创新创业网服务所存在的风险将完全由其自己承担；因其使用菁蓉创新创业网服务而产生的一切后果也由其自己承担，创新中心对用户不承担任何责任。
6.2 菁蓉创新创业网不担保网络服务一定能满足用户的要求，也不担保网络服务不会中断，对网络服务的及时性、安全性、准确性也都不作担保。
6.3菁蓉创新创业网力求但不保证其发布的各类信息的准确性和更新的及时性。
6.4通过本网网页而链接及得到的资讯、产品及服务，所涉及到的法律问题，菁蓉创新创业网不承担任何责任。
6.5 除本网注明之服务条款外，其它因使用本网而引致的任何意外、疏忽、合约毁坏、诽谤、版权或知识产权侵犯及其所造成的各种损失（包括因下载而感染电脑病毒），本网概不负责，亦不承担任何法律责任。
7. 服务变更、中断或终止
7.1 如因系统维护或升级的需要而需暂停网络服务，菁蓉创新创业网将尽可能事先进行通告，但无需为此对任何用户或第三方承担任何责任。
7.2 如发生下列任何一种情形，创新中心有权随时中断或终止向用户提供本协议项下的网络服务而无需通知用户亦无需对任何用户或第三方承担任何责任：
(a) 用户提供的个人资料不真实，造成创新中心声誉及利益上的损失；
(b) 用户违反本协议中规定的使用规则。
7.3 除前款所述情形外，菁蓉创新创业网同时保留在不事先通知用户的情况下随时变更、中断或终止部分或全部网络服务的权利，对于部分或所有服务的变更、中断或终止而造成的任何损失，菁蓉创新创业网无需对用户或任何第三方承担任何责任。
8. 违约赔偿
8.1 用户同意保障和维护菁蓉创新创业网及其他用户的利益，如因用户违反有关法律、法规或本协议项下的任何条款而给菁蓉创新创业网或任何其他第三人造成损失，用户同意承担由此造成的损害赔偿责任。
9. 修改协议
9.1 菁蓉创新创业网将可能不时地修改本协议的有关条款，一旦条款内容发生变动，菁蓉创新创业网将会在相关的页面上提示修改内容。
9.2 如果不同意菁蓉创新创业网对本协议条款所做的修改，用户有权停止使用本协议项下网络服务。如果用户继续使用网络服务，则视为用户接受本协议条款的变动。
10. 法律管辖
10.1 本协议的订立、执行和解释及争议的解决均应适用中国法律。
10.2 如双方就本协议内容或其执行发生任何争议，双方应尽量友好协商解决；协商不成时，任何一方均可向菁蓉创新创业网所在地的人民法院提起诉讼。
11. 通知和送达
11.1 本协议项下所有的通知均可通过重要页面公告、电子邮件或常规的信件传送等方式进行；该等通知于发送之日视为已送达收件人。
12. 其他规定
12.1 本协议构成双方对本协议之约定事项及其他有关事宜的完整协议，除本协议规定的之外，未赋予本协议各方其他权利。
12.2 如本协议中的任何条款无论因何种原因完全或部分无效或不具有执行力，本协议的其余条款仍应有效并且有约束力。
12.3 本协议中的标题仅为方便而设，在解释本协议时应被忽略。
                     </textarea>
                </div>
                <div class=" form-group" >
                    <div class="row">
                        <div class="col-md-4 col-xs-4 col-sm-4"></div>
                        <div class="col-md-2 col-xs-2 col-sm-2 text-center">
                            <button type="reset" class="btn btn-default active btn-lg">重置</button>

                        </div>
                        <div class="col-md-2 col-xs-2 col-sm-2 text-center">
                            <button type="submit" class="btn  btn-warning  btn-lg" id="send">注册</button>
                        </div>
                        <div class="col-md-4 col-xs-4 col-sm-4"></div>
                    </div>

                </div>
            </form>

        </div>
        <ul>
            <li class="regosterLiSolid"></li>
            <li class="regosterLiSolid2"></li>
            <li class="regosterLiSolid3"></li>
        </ul>
    </div>


</section>
<!--协议-->

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

</body>
</html>
<!--验证用户基本资料js文件-->
<?=Html::jsFile(Yii::$app->params['asserts_url'].'ucenter/js/register/bs_register.js') ?>

<script type="text/javascript">
    //等待dom元素加载完毕.
    $(document).ready(function(){
        var $cr = $("#agreement");  //jQuery对象
        $cr.click(function(){
            if($cr.is(":checked")){ //jQuery方式判断
                $(".fffff").html('');
            }else {
                $(".fffff").html('请先同意');
            }
        })
    });
</script>
