<?php
/**
 * 开发工具: PhpStorm.
 * 作   者: mybook-lhp
 * 日   期: 16/11/3
 * 功能说明: 这是一个友情链接管理的文件
 */

namespace app\modules\cms\controllers;

use app\exts\QrckController;
use app\models\CmsFlink;
use app\services\common\StateCode;
use common\services\SerFilesUpload;
use Yii;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;


class FlinkController extends QrckController
{

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['GET'],
                'view' => ['GET'],
                'create' => ['POST'],
                'update' => ['PUT', 'POST'],
                'delete' => ['DELETE'],
            ],
        ];
        return $behaviors;
    }

    /**
     * 获取Flink的数据列表
     * @access public
     * @sinc 1.0
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionIndex()
    {
        $page_no = Yii::$app->request->get("page_no", 1);
        $page_size = Yii::$app->request->get("page_size", Yii::$app->params['default']['page_size']);
        $model = CmsFlink::find()->where('status<9');
        $total = $model->count();
        $offset = ($page_no - 1) * $page_size;
        $data = $model->orderBy('id DESC')->offset($offset)->limit($page_size)->asArray()->all();
        $res = ['total' => $total, 'rows' => $data];
        return $res;
    }

    /**
     * 获取FLink单个数据
     * @return null|static
     */
    public function actionView()
    {

        $id = Yii::$app->request->get('id', 0);
        $data = CmsFlink::findOne($id);
        if ($data) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(StateCode::SUCCESS);
        }
        return $data;
    }

    /**
     * 添加Flink数据
     * @return Flink
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {

//        $img = self::upload();
        //写入数据库
        $model = new CmsFlink();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
//        $model->setAttributes(['img' => $img]);
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(StateCode::SUCCESS);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('添加失败!');

        }

        return $model;
    }

    /**
     * 修改Flink数据
     * @return null|static
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate()
    {

        $img = self::upload();

        //数据更新
        $id = Yii::$app->request->get('id', 0);
        $model = CmsFlink::findOne($id);
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $model->setAttributes(['img' => $img]);
        $model->updateAttributes(['updated' => date('Y-m-d H:i:s', time())]); //更新时间
        $model->updateAttributes(['updater' => 55]); //更新作者
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(StateCode::SUCCESS);
        } elseif (!$model->hasErrors()) {

            throw new ServerErrorHttpException('更新失败!');
        }
        return $model;

    }


    /**
     * 删除Flink数据
     * @return null|static
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */
    public function actionDelete()
    {

        $id = Yii::$app->request->get('id', 0);

        $model = CmsFlink::findOne($id);
        if ($model) {
            if ($model->delete() === false) {
                throw new ServerErrorHttpException('删除失败');

            } else {
                throw new BadRequestHttpException('请求数据错误!');

            }

        }
        return $model;
    }

    /**
     * 文件上传
     * @return string
     */
    static private function upload()
    {

        //上传文件
        $serverurl = Yii::$app->params['default']['Upload_server_url'];
        $data = [
            'path' => 'mg/cms/',
            'size' => Yii::$app->params['default']['upload_max_size'],
            'type' => Yii::$app->params['default']['Upload_type'],
        ];

        $filename = Yii::$app->params['default']['Upload_temp_url'];
        $img = SerFilesUpload::arrCurlupload($serverurl, $filename, $data);
        if (!$img) {
            $img = '';  //可改为默认图片
        }
        return $img;
    }


}
