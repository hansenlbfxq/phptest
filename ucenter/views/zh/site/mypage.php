<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
AppAsset::register($this);
AppAsset::addCss($this,'ucenter/css/site/mypage.css');
?>

<div class="contentAll">
    <!--表单-->
    <div class="membershipForm">
        <!--表单名-->
        <div class="fromname">
            <h3>高级会员申请</h3>
        </div>
        <div class="fromSolid"></div>
        <!--表单内容-->
        <form class="formcontent" method="post" action="formcontent" name="formcontent">

            <div class="companyDiv">
                <label>单位名称（营业执照注册名称):</label>
                <input type="text" name="companyName">
                <label>注册资金:</label>
                <input type="text" name="registeredFund">
            </div>

            <div class="formAll">
                <ul>
                    <li>所属孵化器：</li>
                    <li>行业领域：</li>
                    <li> 企业产品介绍：</li>
                </ul>

                <ul>
                    <li><select name="incubator">
                        <option value ="volvo">Volvo</option>
                        <option value ="saab">Saab</option>
                        <option value="opel">Opel</option>
                        <option value="audi">Audi</option>
                    </select></li>
                    <li>
                        <input type="checkbox" name="businessOne" value="">下一代网络
                        <input type="checkbox" name="businessTwo" value="">下一代网络
                    </li>

                    <li><textarea name="product" class="memberText "></textarea></li>
                    <li><button  type="button" value="提交申请" class="formButton">提交申请</button></li>
                </ul>

            </div>

        </form>
        </div>
    </div>
