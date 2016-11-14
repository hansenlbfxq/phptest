<?php

namespace app\modules\test\controllers;

use Yii;
use yii\rest\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\services\common\StateCode as StateCode;
use common\utils\UtilEncryption;
use common\services\SerMailContent;


class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'view' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        var_dump(SerMailContent::getRegistActiveContent());exit;

        $up=new uploadfile();
        $up->Action_Upload();

        exit;
        $str=UtilEncryption::encryptMD5("aaa","asdfasdasdfasdf");
        echo $str;exit;
    	return StateCode::SUCCESS;
    }

     public function actionView()
    {
    	$data=Yii::$app->request->post();
    	//$data=Channel::findOne(1);
    	return $data;exit;
    }
}




class uploadfile {

    public function Action_Upload(){

        $furl = "@D:/www/qrck/test.txt";
        $url = "http://localhost/up.php";
        $data = ['path' => '/1/1/', 'size' => 10000, 'type' => 'jpg,png,zip'];
        return $this->upload_file_to_cdn($furl, $url, $data);
    }

    public function upload_file_to_cdn($furl, $url, $data){

       
        //  初始化
        $ch = curl_init();
        $post_data = array(
            "file" => $furl
        );

        //$filenmae=curl_file_create("D:/www/qrck/test.txt", "text/plain", '');
        $filenmae= curl_file_create('D:/www/qrck/test.txt','image/jpeg','test_name');
        $post_data = array('file' => $filenmae);


        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//执行结果是否被返回，0是返回，1是不返回

        curl_setopt($ch, CURLOPT_HEADER, 0);//参数设置，是否显示头部信息，1为显示，0为不显示
        //伪造网页来源地址,伪造来自百度的表单提交
        //        curl_setopt($ch, CURLOPT_REFERER, "http://www.baidu.com");
        //表单数据，是正规的表单设置值为非0
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);//设置curl执行超时时间最大是多少
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        //   执行并获取结果
        curl_exec($ch);

        $re = curl_multi_getcontent($ch);
        curl_close($ch);

        echo ($re);
        return $re;
    }
}