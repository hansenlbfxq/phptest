<?php
namespace common\services;
use app\models\BsMember;
use common\utils\UtilEncryption;

class Login{

    /*
     * 返回值是状态1表示登录成，2和3 表示密码或者用户名错误，4表示邮箱未激活
     */
    public static function Login($login_name,$pwd){
            $model = new BsMember();
            $res = $model::find()->where(['login_name'=>$login_name])->one();
            if(!$res){
//                echo '登录失败,用户名或者密码错误';
                return 2;
            }
            //重构密码
            $secret = \Yii::$app->params['pwd'];
            $newPwd = UtilEncryption::encryptMd5($pwd,$secret);

            if($res['pwd']!==$newPwd){
//                echo '登录失败,用户名或者密码错误';
                return 3;
            }
        if($res['email_status']==1){
//                echo '尊敬的用户你好，你还未通过邮箱激活，请先登录邮箱激活，再次登录';
            return 4;
        }
        return  1;

    }
}