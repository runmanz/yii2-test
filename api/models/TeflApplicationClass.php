<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class TeflApplicationClass extends ActiveRecord
{
    public static function tableName()
    {
        return 'tf_tefl_application_class';
    }
    public function rules()
    {
        return [
            [['name_en'], 'required'],
            [['name_en','name_cn'], 'string', 'max' => 50],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_en' => 'English name',
            'name_cn' => '中文名称',
            'p_id' => '父级id',
            'sort' => '排序',
        ];
    }

}