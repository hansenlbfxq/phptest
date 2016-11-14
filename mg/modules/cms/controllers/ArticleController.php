<?php


namespace app\modules\cms\controllers;

use app\exts\QrckController;
use app\models\CmsArticle;
use app\models\CmsArticleAccessory;
use app\services\common\DumpCode;
use app\services\common\StateCode;
use common\services\SerFilesUpload;
use common\utils\UtilFilter;
use Yii;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;


class ArticleController extends QrckController
{
    /**
     * 未完成工作
     * 文章条件查询,文章附件管理
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'index' => ['GET'],
                'view' => ['GET'],
                'create' => ['POST'],
                'update' => ['PUT'],
                'delete' => ['DELETE'],
                'status' => ['PUT']
            ],
        ];
        return $behaviors;
    }

    /**
     * 获取Article的数据列表
     * @access public
     * @sinc 1.0
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionIndex()
    {

        $keyword = Yii::$app->request->get("keyword", "");
        $category_id = Yii::$app->request->get("category_id", "");
        $status = Yii::$app->request->get("status", "");

        $page_no = Yii::$app->request->get("page", 1);
        $page_size = Yii::$app->request->get("rows", 1);
        $model = CmsArticle::find()->where('status<9');
        if (!empty($status)) {
            $status = UtilFilter::addslashesStr($status);
            $model->andWhere(" status = $status");
        }

        if (!empty($category_id)) {
            $category_id = UtilFilter::addslashesStr($category_id);
            $category = explode(',', $category_id);
            foreach ($category as $key => $item) {
                if ($key == 0) {
                    $model->andWhere(" category_id = $item");
                }
                $model->orWhere(" category_id = $item");
            }

        }

        if (!empty($keyword)) {
            $keyword = UtilFilter::addslashesStr($keyword);
            $model->andWhere(" title like '%$keyword%' ");
            $model->orWhere(" keywords like '%$keyword%' ");
            $model->orWhere(" description like '%$keyword%' ");
        }

        $total = $model->count();
        $offset = ($page_no - 1) * $page_size;
        $data = $model->orderBy('id DESC')->offset($offset)->limit($page_size)->asArray()->all();

        $dataAll = array();
        foreach ($data as $key => $item) {
            $dataAll[$key] = $item;
            $dataAll[$key]['accessory'] = $this->Accessory($item['id']);
        }

        $res = ['total' => $total, 'rows' => $dataAll];
        return $res;
    }

    /**
     * 获取附件信息
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    private function Accessory($id)
    {
        $model = CmsArticleAccessory::find()->where("article_id = $id")->asArray()->all();
        return $model;
    }

    /**
     * 获取Article单个数据
     * @return null|static
     */
    public function actionView()
    {

        $id = Yii::$app->request->get('id', 0);
        $data = CmsArticle::findOne($id)->toArray();
        if ($data) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(StateCode::SUCCESS);
        }
        $data['accessory'] = $this->Accessory($id);
        return $data;
    }

    /**
     * 创建Article数据
     * @return Article
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
//        DumpCode::P(Yii::$app->getRequest()->getBodyParams());exit;

        $model = new CmsArticle();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        if ($model->save()) {
            if (!empty($_FILES)) {
                $upret = $this->upload($model->id);
            } else {
                $upret = true;
            }
            if ($upret) {
                return $model;
            } elseif (!$model->hasErrors()) {
                throw new ServerErrorHttpException('创建数据失败。');
            }
            return $model;
        }

    }


    /**
     * 修改Article数据
     * @return null|static
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate()
    {

        $id = Yii::$app->request->get("id", 0);
        $model = CmsArticle::findOne($id);
        if ($model) {
            $model->load(Yii::$app->getRequest()->getBodyParams(), '');
            if ($model->save()) {
                if (!empty($_FILES && count($_FILES) !== 0)) {
                    $upret = $this->upload($model->id);
                    if ($upret) {
                        return $model;
                    } else {
                        throw new ServerErrorHttpException('文件上错误。');
                    }
                } else {
                    return $model;

                }

            } elseif (!$model->hasErrors()) {
                throw new ServerErrorHttpException('更新数据失败。');
            }
        } else {
            throw new BadRequestHttpException('更新数据失败。');
        }

    }

    /**
     * 附件删除
     * @return null|static
     * @throws ServerErrorHttpException
     */
    public function actionDeleteacc()
    {
        $name = Yii::$app->request->post('name', '');
        $article_id = Yii::$app->request->post('article_id', 1);
        $data = CmsArticleAccessory::find()->where(['and', "name='$name'", "article_id= $article_id"])->asArray()->all();
        $path = Yii::$app->params['default']['Upload_server_url'];
        $filename = $data[0]['path'];
        $dre = SerFilesUpload::delete($path, $filename);

        if ($dre == 'ok') {

            $model = CmsArticleAccessory::findOne($data[0]['id']);

            if ($model) {
                if ($model->delete() === false) {
                    throw new ServerErrorHttpException('删除失败');
                }
            }
            return $model;
        }
    }


    /**
     * 删除Article数据
     * @return null|static
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */
    public function actionDelete()
    {

        $id = Yii::$app->request->get('id', 0);

        $model = CmsArticle::findOne($id);

        if ($model) {
            if ($model->setAttributes(['status' => 9]) === false) {
                throw new ServerErrorHttpException('删除失败');

            } else {
                throw new BadRequestHttpException('请求数据错误!');

            }

        }
        return $model;
    }


    /**
     *
     * 修改Article数据的各种状态  ，删除，发布，取消发布等。
     *
     * @access public
     * @since 1.0
     * @throws BadRequestHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionStatus()
    {

        $parm = Yii::$app->getRequest()->getBodyParams();

        $ids = isset($parm['ids']) ? $parm['ids'] : "";
        $status = isset($parm['status']) ? $parm['status'] : "";

//        DumpCode::P($ids);exit;
        if (empty($ids) || empty($status)) {
            throw new BadRequestHttpException('请求数据错误。', StateCode::REQUEST_ERROR);
        } else {
            $ids = explode(",", $ids);
            foreach ($ids as $i) {
                $model = CmsArticle::findOne($i);
                $model->setattribute("status", $status);
                $model->save();
            }
            return ['code' => StateCode::SUCCESS];
        }
    }

    /**
     * 文件上传
     * @return string
     */
    static private function upload($id)
    {
        if (!empty($_FILES)) {
            //上传文件
            $img = null;
            $serverurl = Yii::$app->params['default']['Upload_server_url'];
            $data = [
                'path' => 'mg/cms/',
                'size' => Yii::$app->params['default']['upload_max_size'],
                'type' => Yii::$app->params['default']['Upload_type'],
            ];

            $filename = Yii::$app->params['default']['Upload_temp_url'];
            $img = SerFilesUpload::arrCurlupload($serverurl, $filename, $data);
            if (!$img) {
                return "文件服务器错误";

            }


            $models = new CmsArticleAccessory();
            foreach ($img as $key => $data) {
                $model = clone $models;
                $model->setAttributes(['name' => $data['name']]); //创建时间
                $model->setAttributes(['size' => "{$data['size']}"]); //创建时间
                $model->setAttributes(['path' => $data['img']]); //创建时间
                $model->setAttributes(['article_id' => $id]); //创建时间
                $model->setAttributes(['created' => date('Y-m-d H:i:s', time())]); //创建时间
                $model->setAttributes(['creater' => $key]); //创建作者

                $re[] = $model->save();

            }

            if ($re) {
                return true;
            }

        } else {
            return false;
        }


    }


}
