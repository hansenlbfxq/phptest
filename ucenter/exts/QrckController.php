<?php

/**
 * 基础模块的能力
 *
 * @author   shixiu<2881501959@qq.com>
 * @version  2.0
 * @since    2.0
 */
namespace app\exts;

use Yii;
use yii\web\Controller;

class QrckController extends Controller
{
    public $language="";

    public function beforeAction($action) {
        $this->language=Yii::$app->language;
        return true;
    }
}