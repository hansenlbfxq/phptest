<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bs_member_person".
 *
 * @property integer $id
 * @property string $member_id
 * @property string $name
 * @property string $mobile
 * @property string $qq
 * @property string $created
 * @property string $updated
 */
class BsMemberPerson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bs_member_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['mobile', 'qq'], 'string', 'max' => 50],
            ["name","required","message"=>"用户名不能为空"],
            ["mobile","required","message"=>"电话号码必须填写"],
            ['mobile', 'match', 'pattern'=> '/^(13[0-9]{9})|(18[0-9]{9})|(14[0-9]{9})|(17[0-9]{9})|(15[0-9]{9})$/', 'message' => '手机格式不正确，请重新输入'],
            ["qq","required","message"=>"电话号码必须填写"],
            ['qq','match','pattern'=>'/^[1-9]\\d{4,10}$/','message'=>'QQ输入有误'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'qq' => 'Qq',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
