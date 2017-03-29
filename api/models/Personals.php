<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "personals".
 *
 * @property int $id 主键，自增id
 * @property string $avatar_url 头像url.存储路径/id/info/*.png
 * @property int $wechat_id wechat表id
 * @property string $name 用户姓名和微信昵称数据类型一致
 * @property string $voice_url voice url语音 存储路径/id/info/*.swf
 * @property int $voice_add_time voice 添加时间
 * @property string $birthday 生日（年月日）
 * @property int $gender 性别：0:"男" 1:"女"
 * @property int $education 学历：0:"高中" 1:"大专" 2:"本科" 3:"硕士" 4:"博士"
 * @property int $seniority 工作年限
 * @property int $salary 期望薪资
 * @property string $position 期望职位
 * @property string $specialty 个人特长标签
 * @property string $phone 联系电话
 * @property string $qrcode 二维码的url。存储路径/id/info/*.png
 */
class Personals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['avatar_url', 'name', 'voice_url', 'voice_add_time', 'birthday', 'position', 'specialty', 'phone', 'qrcode'], 'required'],
            [['wechat_id', 'voice_add_time', 'gender', 'education', 'seniority', 'salary'], 'integer'],
            [['birthday'], 'safe'],
            [['position', 'specialty'], 'string'],
            [['avatar_url', 'voice_url'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20],
            [['qrcode'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'avatar_url' => 'Avatar Url',
            'wechat_id' => 'Wechat ID',
            'name' => 'Name',
            'voice_url' => 'Voice Url',
            'voice_add_time' => 'Voice Add Time',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'education' => 'Education',
            'seniority' => 'Seniority',
            'salary' => 'Salary',
            'position' => 'Position',
            'specialty' => 'Specialty',
            'phone' => 'Phone',
            'qrcode' => 'Qrcode',
        ];
    }
}
