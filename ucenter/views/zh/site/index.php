<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>菁蓉国际创新创业中心</title>
    <?=Html::cssFile(Yii::$app->params['asserts_url']."ucenter/css/site/index.css")?>
</head>
<body>
<header>
    <!--logo-->
        <div class="myLogo">
            <div class="myLogo1"></div>
            <div class="myLogo2"></div>
        </div>
    <!--headeer链接-->
          <div class="headerLink">
            <ul>
                <li><a href="<?=Yii::$app->params['home_url']?>">网站首页</a></li>
                <li><a href="#">我的账户</a></li>
            </ul>
          </div>
</header>
<div class="iframAll">
    <div class="leftMenu">
        <!--线条-->
        <div class="menusolid"></div>
        <!--菜单栏-->
        <ul class='wraplist menu_level_1'>
        <?php
            if(count($menus)>0){
                foreach ($menus as $k1 => $v1) {
        ?>
            <li>
                <span class="treesolid"></span>
                <?php  if(empty($v1['url'])){?>
                    <span class="treeColor menubtn"><?=$v1['name']?></span>
                <?php }else{ ?>
                    <a class="linkspan treeColor" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl([$v1['url']]);?>" target="senioriframe"><span><?=$v1['name']?></span></a>
                <?php } ?>

                
                <?php 
                if(isset($v1['children']) && count($v1['children'])){
                ?>
                 <ul class="menu_level_2 open">
                <?php
                    foreach ($v1['children'] as $k2 => $v2) {
                ?>

                    <li>
                        <span class="treesolid"></span>
                        <?php  if(empty($v2['url'])){?>
                            <span class="menubtn"><?=$v2['name']?></span>
                        <?php }else{ ?>
                            <a class="linkspan" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl([$v2['url']]);?>" target="senioriframe"><span><?=$v2['name']?></span></a>
                        <?php } ?>    

                         <?php 
                         if(isset($v2['children']) && count($v2['children'])){
                        ?>
                         <ul class="menu_level_3 open">
                        <?php
                            foreach ($v2['children'] as $k3 => $v3) {
                        ?>

                            <li>
                                <span class="treesolid"></span>
                                <?php  if(empty($v3['url'])){?>
                                    <span class="menubtn"><?=$v3['name']?></span>
                                <?php }else{ ?>
                                    <a class="linkspan" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl([$v3['url']]);?>" target="senioriframe"><span><?=$v3['name']?></span></a>
                                <?php } ?>    

                            </li>
                        <?php 
                         }
                         ?>
                         </ul>
                         <?php
                        }
                        ?>

                    </li>

                <?php 
                 }
                 ?>
                 </ul>
                 <?php
                }
                ?>
            </li>
        <?php
            }
        }
        ?>
        </ul>
    
    </div>

    <iframe scrolling="no" name="senioriframe" id="senioriframe" frameborder="0" class="senioriframe"  src="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['/site/mypage']);?>"></iframe>
</div>

<footer style="clear: both">
   <div class="container-fluid text-center">
       <p>菁蓉创新创业网 版权所有@2016 成都高新区创新创业服务中心 <a href="#">免责声明 </a> <a href="#">关于我们</a></p>
       <p>地址：中国·成都 邮编：610041 网站备案号：蜀ICP备05009742号</p>
    </div>
</footer>

 <?=Html::jsFile(Yii::$app->params['asserts_url']."ucenter/js/jquery-1.12.4.min.js")?>
 <?=Html::jsFile(Yii::$app->params['asserts_url']."ucenter/js/site/tree.js")?>
</body>
</html>