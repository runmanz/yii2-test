<?php
namespace api\common\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

class CommonController extends Controller
{
    public $modelClass;
    public function behaviors()
    {
        $behaviors =  parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON
        ];
        return $behaviors;
    }

    public function init()
    {
        if(Yii::$app->user->getIsGuest()){
            //echo 'guest';
        }else{
            //echo 'loading';
        }
    }
}