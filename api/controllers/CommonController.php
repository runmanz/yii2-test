<?php
namespace api\controllers;

use Yii;
use yii\rest\Controller;

class CommonController extends Controller
{
    public function init()
    {
        if(Yii::$app->user->getIsGuest()){
            echo 'guest';
        }else{
            echo 'loading';
        }
    }
}