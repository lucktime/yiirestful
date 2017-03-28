<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%positions}}".
 *
 * @property int $position_id 自增id
 * @property int $parent_id 父标签id
 * @property string $position_name 职位名称，能存储25个字
 * @property int $position_type 职位所属级别大类。级别 0 一次递减
 * @property int $click_num 标签被选中次数
 * @property string $add_time 标签添加时间
 * @property int $p_show 标签是否显示 0:"不显示"
 */
class Positions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'positions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'position_name', 'add_time'], 'required'],
            [['parent_id', 'position_type', 'click_num', 'p_show'], 'integer'],
            [['add_time'], 'safe'],
            [['position_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => '自增id',
            'parent_id' => '父标签id',
            'position_name' => '职位名称，能存储25个字',
            'position_type' => '职位所属级别大类。级别 0 一次递减',
            'click_num' => '标签被选中次数',
            'add_time' => '标签添加时间',
            'p_show' => '标签是否显示 0:\"不显示\"',
        ];
    }
}
