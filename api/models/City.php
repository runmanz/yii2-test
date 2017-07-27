<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class City extends ActiveRecord
{
    public static function tableName()
    {
        return 'tf_city';
    }
    public function rules()
    {
        return [
            [['city_en'], 'required'],
            [['city_en','city_cn'], 'string', 'max' => 50],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_en' => 'English name',
            'city_cn' => '中文名称',
            'p_id' => '父级id',
            'sort' => '排序',
        ];
    }

}