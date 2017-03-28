<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "firm_type".
 *
 * @property int $firm_type_id 企业类型主键自增id
 * @property int $parent_id 父类id
 * @property string $firm_name 企业类型名称
 * @property int $firm_type 企业类型级别  0位最大级别（eg:it行业，房地产行业）
 * @property int $click_num 企业类型被点击
 * @property string $add_time 企业类型添加时间
 * @property int $f_show 是否显示该企业名称
 */
class Firmtype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'firm_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'firm_name', 'firm_type', 'add_time'], 'required'],
            [['parent_id', 'firm_type', 'click_num', 'f_show'], 'integer'],
            [['add_time'], 'safe'],
            [['firm_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'firm_type_id' => 'Firm Type ID',
            'parent_id' => 'Parent ID',
            'firm_name' => 'Firm Name',
            'firm_type' => 'Firm Type',
            'click_num' => 'Click Num',
            'add_time' => 'Add Time',
            'f_show' => 'F Show',
        ];
    }
}
