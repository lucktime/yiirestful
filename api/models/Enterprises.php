<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enterprises".
 *
 * @property int $id 自增id
 * @property int $wechat_id wechat表id
 * @property string $avatar_url 头像 url  存储路径 id/info/*.png
 * @property string $name 企业名称
 * @property string $voice_url 语音在服务器的路径 id/info/voice/_swf
 * @property int $voice_add_time 时间戳存储，考虑倒计时，竞价性能更高。
 * @property string $industry 所属行业
 * @property int $teamsize_min 企业最小人数
 * @property int $teamsize_max 企业最大人数
 * @property string $lat 纬度 float，double 四舍五入误差较大
 * @property string $lng 经度 float，double 四舍五入误差较大
 * @property string $specialty 公司特长优势
 * @property string $position 招聘职位列表
 * @property int $phone 联系方式
 * @property string $qrcode 企业二维码 存储路径 id/info/role/*.png
 * @property string $addr 企业所在位置
 */
class Enterprises extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'enterprises';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wechat_id', 'voice_add_time', 'teamsize_min', 'teamsize_max', 'phone'], 'integer'],
            [['avatar_url', 'name', 'voice_url', 'industry', 'specialty', 'position', 'qrcode', 'addr'], 'required'],
            [['industry', 'specialty', 'position', 'addr'], 'string'],
            [['lat', 'lng'], 'number'],
            [['avatar_url', 'name', 'voice_url'], 'string', 'max' => 255],
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
            'wechat_id' => 'Wechat ID',
            'avatar_url' => 'Avatar Url',
            'name' => 'Name',
            'voice_url' => 'Voice Url',
            'voice_add_time' => 'Voice Add Time',
            'industry' => 'Industry',
            'teamsize_min' => 'Teamsize Min',
            'teamsize_max' => 'Teamsize Max',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'specialty' => 'Specialty',
            'position' => 'Position',
            'phone' => 'Phone',
            'qrcode' => 'Qrcode',
            'addr' => 'Addr',
        ];
    }
}
