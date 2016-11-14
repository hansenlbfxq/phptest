<?php

namespace app\models;

use Yii;
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doc_article';
    }
}
