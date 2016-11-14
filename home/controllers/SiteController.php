<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\exts\QrckController;

class SiteController extends QrckController
{

    public function actionIndex(){
       /* $mail= Yii::$app->mailer->compose();   
        $mail->setTo('hansen102030@126.com');  
        $mail->setSubject("邮件测试");  
        //$mail->setTextBody('zheshisha ');   //发布纯文字文本
        $mail->setHtmlBody("<br>问我我我我我");    //发布可以带html标签的文本
        if($mail->send())  
            echo "success";  
        else  
            echo "failse";   
        die(); exit;*/

        echo Yii::$app->language;
         return $this->render("index",[]);
    }
    /**
     *
     * 切换语言
     *
     * @access public
     * @since 1.0
     * @return null
     */
    public function actionLanguage(){
        $locale = Yii::$app->request->get('language');
        if ($locale){
            setCookie("language",$locale,time()+3600*24*30);
        }
        $this->goBack(Yii::$app->request->headers['Referer']);
    }
}
