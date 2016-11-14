<?php
namespace app\controllers;
 
use yii\console\Controller;
use app\models\Article;
use common\services\Elastic;

/**
 * 调用方法
 * d:/wamp/.../php D:/www/XingmimaShopMgr/branches/console/yii  article/check
 */
class ArticleController extends Controller
{
    public function actionCheck()
    {
        $Articles = Article::find()->where("check_flag=2 and status=1")->andWhere("pubdate <='".date('Y-m-d H:i:s')."'")->all();
        foreach($Articles as $model){
            $model->status = 2;
            $model->save();
            echo " $model->id OK！ \n";
        }
    }

    public  function actionUpdate()
    {
        $sql = "select id,shorttitle,title,meta_description,litpic,updated from doc_article where check_flag = 2 and status = 2";

        $Articles = Article::findBySql($sql)->all();
        $ECS = Elastic::getInstance();
        foreach($Articles as $model){
            $ECS::setValue([
                'id' =>  $model->id,
                'title' =>  $model->title,
                'shorttitle' =>  $model->shorttitle,
                'thumbnail' => $model->litpic,
                'des' => $model->meta_description,
                'time' => $model->updated
            ], $model->id);
            echo " $model->id OK！ \n";
        }
        unset($Articles);
        unset($ECS);
    }
}