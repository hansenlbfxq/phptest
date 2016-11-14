<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bs_qa".
 *
 * @property integer $id
 * @property integer $lan
 * @property integer $qtype
 * @property string $content
 * @property integer $status
 * @property string $created
 * @property string $updated
 */
class BsQa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bs_qa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lan', 'qtype', 'status'], 'integer'],
            [['content'], 'string'],
            [['created', 'updated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lan' => 'Lan',
            'qtype' => 'Qtype',
            'content' => 'Content',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
