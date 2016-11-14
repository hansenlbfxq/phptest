<?php
namespace app\controllers;
use app\exts\QrckController;
use app\models\BsBdata;
use app\models\BsMember;
use app\models\BsMemberCompany;
use app\models\BsMemberIncubator;
use app\models\BsMemberPerson;
use app\models\BsMemberService;
use common\services\Login;
use common\services\SerMailContent;
use common\utils\UtilEncryption;
use yii\di\ServiceLocator;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\YiiAsset;


class MemberController extends QrckController{

    public $layout=false;
    /**
     * @return string
     * 注册首页
     */
    public function actionIndex(){
        return $this->render('index');
    }
    /**
     * @return
     * 注册掐一个页面
     */
      public function actionRegister(){

          if(\Yii::$app->request->isPost ){
              $model = new BsMember();
              //得到传入数据
              $list = \Yii::$app->getRequest()->getBodyParams();
              //重新构造list，对密码进行加密
              unset($list['pwdAffirm']);

              $pwd=$list['pwd'];
              //盐值
              $secret=\Yii::$app->params['pwd'];
              //调用公共加密方法
              $newpwd = UtilEncryption::encryptMd5($pwd,$secret);
              $list['pwd']=$newpwd;
             //加载
            $model->load($list, '');

              //验证数据通过
              if ($model->validate()){
                  $model->save();

                  //获取最后插入的用户id
                  $member_id=\Yii::$app->db->getLastInsertID();
                 $list['member_id']=$member_id;
                  //发送邮件开始，调用方法
                $this ->actionSendEmail($list['email'],$member_id,$list['login_name']);

                  //发送邮件结束
                  //判断跳转页面
                 if($list['mtype']==4){
//                     echo "个人页面";
                     return $this->render('person',[
                         'list'=>$list
                     ]);
                 }elseif ($list['mtype']==3){
//                     echo "服务机构保存资料页面";
                     return $this->render('service',[
                         'list'=>$list
                     ]);
                 }elseif ($list['mtype']==2){
//                     echo "孵化器";
                     return $this->render('incubator',[
                         'list'=>$list
                     ]);
                 }elseif ($list['mtype']==1){
//                     echo "创业企业";
                     //关联bsdata表
                     $bsmodel = new BsBdata();
                     $bsdata = $bsmodel::find()->all();
                     //关联孵化器表
                     $cbmodel = new BsMemberIncubator();
                     $cbdata = $cbmodel::find()->all();

                     return $this->render('company',[
                         'list'=>$list,
                         'bsdata'=>$bsdata,
                         'cbdata'=>$cbdata
                     ]);
                 }
              }elseif ($model->hasErrors()){ //验证没有通过
                  echo '注册失败';
              }
          }else{
              return $this->render('register');
          }

      }

    /**
     * @return string
     * 个人注册创建资料页面，添加，手机、QQ ,
     */
      public function actionPerson(){
          if(\Yii::$app->request->isPost){
              $model = new BsMemberPerson();
              //获取数据
              $list = \Yii::$app->getRequest()->getBodyParams();
              $model->load($list,'');
              //验证通过
              if($model->validate()){
                  $model->save();
                  //保存成功跳转
                  $this->redirect(['member/index']);
              }elseif($model->hasErrors()){//验证没有通过
                  echo '保存失败'."<br>";

                  print_r($model->getErrors());
//                  print_r($model->getErrors()['mobile'][0]."<br>");
//                  print_r($model->getErrors()['qq'][0]."<br>");
              }

          }else{
              echo '请正确提交';
          }
      }

      /**
       * 服务机构保存资料
       */
      public function actionService(){
          if(\Yii::$app->request->isPost){
              $model = new BsMemberService();
              //获取数据
              $list = \Yii::$app->getRequest()->getBodyParams();
              $model->load($list,'');
              //验证通过
              if($model->validate()){
                  $model->save();
                  //保存成功跳转
                  $this->redirect(['member/index']);
              }elseif($model->hasErrors()){//验证没有通过
                  echo '保存失败'."<br>";
                  print_r($model->getErrors());
              }

          }else{
              echo '请正确提交';
          }
      }
      /**
       * 孵化器保存资料
       */
      public function actionIncubator(){
          if(\Yii::$app->request->isPost){
              $model = new BsMemberIncubator();
              //获取数据
              $list = \Yii::$app->getRequest()->getBodyParams();

              $model->load($list,'');
              //验证通过
              if($model->validate()){
                  $model->save();
                  //保存成功跳转
                  $this->redirect(['member/index']);
              }elseif($model->hasErrors()){//验证没有通过
                  echo '保存失败'."<br>";
                  print_r($model->getErrors());
              }
          }else{
              echo '请正确提交';
          }
      }
      /**
       * 创业企业保存资料
       */
      public function actionCompany(){
          if(\Yii::$app->request->isPost){
             $model = new BsMemberCompany();
              //获取数据
              $list = \Yii::$app->getRequest()->getBodyParams();

              //关联表bsdata表

              $model->load($list,'');
              //验证通过
              if($model->validate()){
                  $model->save();
                  //保存成功跳转
                  $lastId=\Yii::$app->db->getLastInsertID();

                 //获取到孵化器id
                  $cbId = $list['incubator_id'];

                  $cbmodel = new BsMemberIncubator();

                  $incubator_member_data = $cbmodel::find()->where(['id' => $cbId])->one();
                  $incubator_member_id = $incubator_member_data['member_id'];
                  //添加孵化器会员id
                  $model::updateAll(['incubator_member_id'=>$incubator_member_id],['id'=>$lastId]);
                  $this->redirect(['member/index']);
              }elseif($model->hasErrors()){//验证没有通过
                  echo '保存失败'."<br>";
                  print_r($model->getErrors());
              }
          }else{
              echo '请正确提交';
          }
      }

      /**
       * 发邮件的方法
       */

      public function actionSendEmail($email,$id,$login_name){
          $id = intval($id);
          $email = $email;
          //准备token 值
          $mail = \Yii::$app->mailer->compose();
          $mail ->setTo($email);
          $mail ->setSubject('激活邮件');
          $secret=\Yii::$app->params['pwd'];
          $token = UtilEncryption::encryptHashHmac($email.$id,$secret);
          $url=\Yii::$app->request->getHostInfo().Url::toRoute([
              'activation', 'token' => $token,'id'=>$id
              ]);
          $body = SerMailContent::getRegistActiveContent(['site'=>'菁荣创新创业网','loginname'=>$login_name,'activeurl'=>$url,'siturl'=>\Yii::$app->request->getHostInfo()]);

          $mail -> setHtmlBody($body['title'].$body['content']);

          if(!$mail ->send()){

             return false;
          }else{

              return true;
          }
      }

      /**
       * 激活邮件
       */
      public function actionActivation($token,$id){
          $id = intval($id);
          $model = new BsMember();
          $list = $model::find()->where(['id'=>$id])->one();
          $secret=\Yii::$app->params['pwd'];
          $str = UtilEncryption::encryptHashHmac($list['email'].$id,$secret);
          if($token != $str){
              echo '激活失败，跳转到某个页面';
          }else{
              $res = $model::updateAll(['email_status'=>2],['id'=>$id]);
              if(!$res){
                  $this->render('error_email');
              }
              return $this->render('success_email');
          }
          echo '<hr>';
      }
      /**
       * 登录
       */
    public function actionLogin(){
        if(\Yii::$app->request->isPost){
            $list = \Yii::$app->getRequest()->getBodyParams();
            $res = Login::Login($list['login_name'],$list['pwd']);
            if($res==2){
                echo '用户名或者密码错误';
            }elseif ($res==3){
                echo '密码错误';
            }elseif ($res==4){
                echo '邮箱未激活，请先登录有限激活后重新登录';
            }else{
                return $this->redirect('index');
            }
        }
        return $this->render('login');
    }

    /**
     * 验证用户名唯一性
     */

    public function actionUser_only(){
        if(\Yii::$app->request->isAjax){
            $name = \Yii::$app->request->getBodyParam('name');
            $model = new BsMember();
            $result = $model::find()->where(['login_name'=>$name])->one();

           if($result){

               return true;
               exit;
           }else{
               return false;
               exit;
           }
        }

    }
    /**
     * 邮箱验证
     */

    public function actionEmail_only(){
        if(\Yii::$app->request->isAjax){
            $email = \Yii::$app->request->getBodyParam('email');
            $model = new BsMember();
            $result = $model::find()->where(['email'=>$email])->andWhere(['email_status'=>2])->one();
            if($result){
                return true;
                exit;
            }else{
                return false;
                exit;
            }
        }
    }
}