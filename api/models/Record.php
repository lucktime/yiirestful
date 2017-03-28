<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%record}}".
 *
 * @property int $id 主键自增id
 * @property int $person_id 用户id
 * @property int $enter_id 企业id
 * @property int $matchState 关注状态 0:"互相不关注" 1：企业关注用户 2：用户关注企业 5：互相关注
 * @property string $updatedAt 关注更新时间
 * @property string $remove_time 关注的移除时间，当两者关注达到一定时间后，会自动移除个人和企业的关系。并将关注状态设置为互不关注
 */
class Record extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'enter_id', 'updatedAt', 'remove_time'], 'required'],
            [['person_id', 'enter_id', 'matchState'], 'integer'],
            [['updatedAt', 'remove_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键自增id',
            'person_id' => '用户id',
            'enter_id' => '企业id',
            'matchState' => '关注状态 0:\"互相不关注\" 1：企业关注用户 2：用户关注企业 5：互相关注',
            'updatedAt' => '关注更新时间',
            'remove_time' => '关注的移除时间，当两者关注达到一定时间后，会自动移除个人和企业的关系。并将关注状态设置为互不关注',
        ];
    }
}
