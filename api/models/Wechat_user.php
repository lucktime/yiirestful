<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wechat_user".
 *
 * @property int $id
 * @property string $openid
 * @property string $nickname 微信昵称
 * @property int $sex 性别
 * @property string $headimgurl 头像
 * @property string $country 国家
 * @property string $province 省份
 * @property string $city 城市
 * @property string $3rd_session
 * @property string $created_at
 * @property int $role 角色(1 企业，2个人，99后台管理员)
 */
class Wechat_user extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid', 'nickname', 'sex', 'headimgurl', 'country', 'province', 'city', '3rd_session'], 'required'],
            [['sex', 'role'], 'integer'],
            [['created_at'], 'safe'],
            [['openid', 'headimgurl', '3rd_session'], 'string', 'max' => 255],
            [['nickname', 'country', 'province', 'city'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => 'Openid',
            'nickname' => '微信昵称',
            'sex' => '性别',
            'headimgurl' => '头像',
            'country' => '国家',
            'province' => '省份',
            'city' => '城市',
            '3rd_session' => '3rd Session',
            'created_at' => 'Created At',
            'role' => '角色(1 企业，2个人，99后台管理员)',
        ];
    }
}
