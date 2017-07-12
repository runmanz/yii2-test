<?php
namespace app\controllers;

use Yii;

class ResisterController extends CommonController
{
    public function behaviors()
    {
        return [
            'access' => [
            ]
        ];
    }

    public function actionIndex(){
        echo 1111;die;
    }
}