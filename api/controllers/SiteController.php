<?php
namespace api\controllers;

use app\models\AllOptions;
use app\models\City;
use app\models\TeflApplicationClass;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use api\models\LoginForm;
use api\models\PasswordResetRequestForm;
use api\models\ResetPasswordForm;
use api\models\SignupForm;
use api\models\ContactForm;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /*   $str = '';
             $p = '/>(.*)?<.*> (.*)? /i';
             $p = '/>(.*)?</i';
             preg_match_all($p,$str,$out);
             dd($out[1]);die;*/
            //$transaction = Yii::$app->db->beginTransaction();
        //die;
        /*$city = City::find()->where("`level`=1")->all();
        foreach ($city as $k=>$v){
            $s_city = Yii::$app->db->createCommand("select * from tf_city WHERE `p_id`=:p_id order by sort asc",[':p_id'=>$v['id']]);
            $city['s_city'] = $s_city;
        }
        var_dump($city);die;
        dd($city);*/
        return $this->render('index');
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        /*$a = yii::$app->db->createCommand("select * from tf_time_test where time1=:time1",array(":time1"=>'-2147483648'))->queryOne();
        echo $a['time'];
        echo "<br>".date("Y-m-d H:i:s",$a['time1']);
        $b = "1901-12-13 20:45:52";
        $c = new \DateTime("1901-12-13 20:45:52");
        echo "<br>".$c->getTimestamp()."<br>";
        $d = new \DateTime();
        $d->setTimestamp($c->getTimestamp());
        echo date("Y-m-d H:i:s",$d->getTimestamp());
        die;*/
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     *
     *
     * @return mixed
    */
    public function actionTranslation(){
        $ao = new AllOptions();
        $city = new City();
        $tac = new TeflApplicationClass();
        $ao_names = $ao::find()->select('name_en,name_cn')->all();
        $city_names = $city::find()->select('city_en,city_cn')->all();
        $tac_names = $tac::find()->select('name_en,name_cn')->all();
        $arr = array();
        echo "# Translations mixed<br>";
        echo "中文 | 英文<br>";
        echo "--- | ---<br>";
        foreach ($ao_names as $k=>$v){
            $arr[] = [
                'name_en' => $v['name_en'],
                'name_cn' => $v['name_cn']
            ];
            echo $v['name_en']?$v['name_en']:"-";
            echo " | ";
            echo $v['name_cn']?$v['name_cn']:"-";
            echo "<br>";
        }
        foreach ($city_names as $k=>$v){
            $arr[] = [
                'name_en' => $v['city_en'],
                'name_cn' => $v['city_cn']
            ];
            echo $v['city_en']?$v['city_en']:"-";
            echo " | ";
            echo $v['city_cn']?$v['city_cn']:"-";
            echo "<br>";
        }
        foreach ($tac_names as $k=>$v){
            $arr[] = [
                'name_en' => $v['name_en'],
                'name_cn' => $v['name_cn']
            ];
            echo $v['name_en']?$v['name_en']:"-";
            echo " | ";
            echo $v['name_cn']?$v['name_cn']:"-";
            echo "<br>";
        }
        die;
        return $this->render('translation');
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            //var_dump($model);die;
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
