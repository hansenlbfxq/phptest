<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\exts\QrckController;
use app\models\BsMember;
use app\models\BsMenu;
use common\services\SerTree;

class SiteController extends QrckController
{
	/**
     *
     * 会员中心首页
     *
     * @access public
     * @since 1.0
     * @return null
     */
    public function actionIndex(){
    	$this->layout=false;
        $memberid=1;


        //----------以下是获取用户的菜单-------
        $memberinfo=BsMember::findOne($memberid);
        $access=@$memberinfo->access;
        $menus=array();
        if(!empty($access)){
            $access=explode(",",$access);
            $pids=[];
            foreach ($access as $key => $value) {
                if(!array_key_exists($value, $pids)){
                    $data=BsMenu::findOne($value);
                    if($data){
                        $m=$data->toArray();
                        $menus[]=$m;
                        $parentid=$m['parent_id'];
                        @$pids[$value]=1;

                        if(!array_key_exists($parentid, $pids) && $parentid >0){
                            $parents=BsMenu::findOne($parentid)->toArray();
                            $menus[]=$parents;
                            @$pids[$parentid]=1;

                            $ppid=$parents['parent_id'];
                             if(!array_key_exists($ppid, $pids) && $ppid >0){
                                $parents=BsMenu::findOne($ppid)->toArray();
                                $menus[]=$parents;
                                @$pids[$ppid]=1;
                             }

                        }
                    }
                }
            }

           

            $menus=SerTree::formatTree($menus,"id","parent_id");

        }
        return $this->render("index",['menus'=>$menus]);
    }
    /**
     *
     * 个人主页
     *
     * @access public
     * @since 1.0
     * @return null
     */
    public function actionMypage(){
         return $this->render("mypage",[]);
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
