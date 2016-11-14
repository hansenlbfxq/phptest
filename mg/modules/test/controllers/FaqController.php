<?php

namespace app\modules\test\controllers;

use Yii;
use yii\rest\ActiveController;


class FaqController extends ActiveController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

     public $modelClass = 'app\models\BsQa';
}
