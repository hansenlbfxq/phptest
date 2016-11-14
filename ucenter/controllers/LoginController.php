<?php
namespace app\controllers;

use app\exts\QrckController;
use app\models\BsMember;
use app\models\BsMemberCompany;
use app\models\BsMemberIncubator;
use app\models\BsMemberPerson;
use app\models\BsMemberService;
use common\services\Login;
use common\utils\UtilEncryption;

class LoginController extends QrckController{
    /**
     * 登录
     */
    public function actionLogin(){
        if(\Yii::$app->request->isPost){
            $list = \Yii::$app->getRequest()->getBodyParams();
            $res = Login::Login($list['login_name'],$list['pwd']);
            if($res==2){

//                echo"<script type='text/javascript'>alert('用户名或密码错误');location='login';</script>";
                echo '用户名或者密码错误';
            }elseif ($res==3){

                echo '密码错误';
            }elseif ($res==4){
                echo '邮箱未激活，请先登录有限激活后重新登录';
            }elseif($res ==1 ){
                $model = new BsMember();
                $secret  = \Yii::$app->params['pwd'];
                $pwd = $list['pwd'];
                $pwd = UtilEncryption::encryptMd5($pwd,$secret);
                //查询基本数据
                $bs_data = $model::find()->where(['login_name'=>$list['login_name']])->andWhere(['pwd'=>$pwd])->one();
//                return $this->render('index',['bs_data'=>$bs_data]);
//                return $this->render('edit_pwd',['list'=>$bs_data]);

                return $this->redirect('/site/mypage',['list'=>$bs_data]);
                //查询子数据,根据mtype 判断需要哪一张表
//                $mtype = $bs_data['mtype'];
                //个人
//                if($mtype == 4){
//                    $model = new BsMemberPerson();
//                    $bs_data_person = $model::find()->where(['member_id'=>$bs_data['id']])->one();
//                    return $this->render('index_person',[
//                        'bs_data'=>$bs_data,
//                        'bs_data_person'=>$bs_data_person
//                    ]);
//                }elseif ($mtype==3){//服务
//                    $model = new BsMemberService();
//                    $bs_data_service = $model::find()->where(['member_id'=>$bs_data['id']])->one();
//                    return $this->render('index_service',[
//                        'bs_data'=>$bs_data,
//                        'index_service'=>$bs_data_service
//                    ]);
//                }elseif ($mtype == 2){//孵化器
//                    $model = new BsMemberIncubator();
//                    $bs_data_incubator = $model::find()->where(['member_id'=>$bs_data['id']])->one();
//                    return $this->render('index_incubator',[
//                        'bs_data'=>$bs_data,
//                        'index_service'=>$bs_data_incubator
//                    ]);
//                }elseif ($mtype == 1){//创业企业
//                    $model = new BsMemberCompany();
//                    $bs_data_company = $model::find()->where(['member_id'=>$bs_data['id']])->one();
//                    return $this->render('index_company',[
//                        'bs_data'=>$bs_data,
//                        'index_service'=>$bs_data_company
//                    ]);
//                }

            }
        }
        return $this->render('login');
    }
    /**
     * 查看资料
     */
    public function actionEdit(){
        $id = $_POST['id'];
        $model = new BsMember();
        $list = $model::find()->where(['id'=>$id])->one();
        return $this-> render('edit',[
            'list'=>$list
        ]);
    }
    /**
     * 更新
     */
    public function actionUpdate(){
        $list = \Yii::$app->getRequest()->getBodyParams();
        $model = new BsMember();
        $res = $model::updateAll(['email'=>$list['email'],'nick_name'=>'nick_name'],['id'=>$list['id']]);
        if(!$res ){
            echo '修改失败';
        }
        //修改成功跳转到的页面
      $this->goBack();
    }
    /**
     * 修改密码
     */
    public function actionEdit_pwd(){
        $list = \Yii::$app->getRequest()->getBodyParams();
        $id= $list['id'];
        $id = intval($id);
        //对用户输入的密码重构加密
        $pwd =$list['old_pwd'];
        $secret = \Yii::$app->params['pwd'];
        $old_pwd = UtilEncryption::encryptMd5($pwd,$secret);

       //根据用户的id去查询数据然后比较用户输入的旧密码是否相同；相同且用户存在，就允许修改密码，如果两次密码输入不一样，也阻止用户修改
        $model =  new BsMember();
        $data = $model::find()->where(['id'=>$id])->one();
        if(!$data){
            echo '该用户不存在,请不要乱修改';
            exit;
        }
        if($old_pwd !== $data['pwd']){
            echo '原始密码错误,请重新输入正确在做修改';
            exit;
        }
        if(empty($list['pwd1']) || empty($list['pwd2'])){
            echo '密码不能为空';
            exit;
        }
        if($list['pwd1']!==$list['pwd2']){
            echo '新密码两次输入不一致，请输入正确';
           return false;
        }
        $newpwd = UtilEncryption::encryptMd5($list['pwd1'],$secret);
        $res = $model::updateAll(['pwd'=>$newpwd],['id'=>$id]);
        if(!$res){
            echo '修改密码失败';
            exit;
        }else{
            echo '修改密码成功，请牢记密码';
            exit;
        }

    }

    /**
     * 修改企业信息，得要用户的类型mtype，和id（对应下级表的member_id）
     */
    public function actionEdit_person(){
        //mtype ==4 的时候

    }

}