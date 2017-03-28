<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%specialty}}".
 *
 * @property int $special_id 性格自增id
 * @property string $special_name 性格名称
 * @property int $click_num 该性格被选中次数
 * @property int $s_show 性格是否被展示 0:"不展示"
 * @property string $add_time 性格标签被添加时间
 */
class Specialty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specialty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['special_name', 'add_time'], 'required'],
            [['click_num', 's_show'], 'integer'],
            [['add_time'], 'safe'],
            [['special_name'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'special_id' => '性格自增id',
            'special_name' => '性格名称',
            'click_num' => '该性格被选中次数',
            's_show' => '性格是否被展示 0:\"不展示\" ',
            'add_time' => '性格标签被添加时间',
        ];
    }
}
