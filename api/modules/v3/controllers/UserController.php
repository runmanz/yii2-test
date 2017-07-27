<?php
/**
 * Created by PhpStorm.
 * User: Teachfuture
 * Date: 2017/7/14
 * Time: 11:20
 */

namespace app\modules\v3\controllers;

use Yii;
use app\models\User;
use yii\rest\Controller;
use api\modules\v3\models\SignupForm;
use yii\filters\auth\HttpBasicAuth;

class UserController extends Controller
{
    public $classClass;
    public $authority = 'isAuthor';
   /* public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
        ];
        return $behaviors;
    }*/
    public function execute($user, $item, $params)
    {
        return isset($params['post']) ? $params['post']->createdBy == $user : false;
    }
    public function actions()
    {
        $actions = parent::actions();

        // 禁用"delete" 和 "create" 动作
        unset($actions['delete'], $actions['create']);

        // 使用"prepareDataProvider()"方法自定义数据provider
        //$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function actionIndex(){
        if(yii::$app->user->can('updatePost')){
            return User::find()->limit(3)->all();
        }
        return ['msg'=>'U can\'t see them 3'];
    }

    public function actionCreate(){
        $model = new SignupForm();
        if(yii::$app->user->can('createPost')){
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
        return ['msg' => 'U can\'t  register in my website'];
    }
}