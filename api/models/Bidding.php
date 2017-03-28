<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bidding".
 *
 * @property int $id 竞价表主键自增id
 * @property int $uid 用户id
 * @property int $apply_status 报名状态 0:未报名 1:报名
 * @property int $apply_at 报名时间
 * @property int $user_type 用户类型 1:个人 2:企业
 * @property int $valid 报名是否有效 0:无效 1:有效
 */
class Bidding extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bidding';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid', 'apply_status', 'apply_at', 'user_type', 'valid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'apply_status' => 'Apply Status',
            'apply_at' => 'Apply At',
            'user_type' => 'User Type',
            'valid' => 'Valid',
        ];
    }
}
