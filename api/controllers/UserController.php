<?php
/**
 * Created by PhpStorm.
 * User: Teachfuture
 * Date: 2017/7/14
 * Time: 11:20
 */

namespace api\controllers;

use Yii;
use app\models\User;
use yii\rest\Controller;
use api\models\SignupForm;

class UserController extends Controller
{

    public function actionIndex(){
        return User::find()->limit(10)->all();
    }

    public function actionCreate(){
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            //var_dump($model);die;
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return ['msg' => 'successful'];
                }
            }
        }
        return ['msg' => $model->getErrors()];
    }
}