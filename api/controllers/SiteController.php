<?php
namespace api\controllers;

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
use Faker\Provider\DateTime;
use api\common\controllers\CommonController;
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
/*        $str = "
'Beijing','北京'
'Anhui','安徽'
'Fujian','福建'
'Gansu','甘肃'
'Guangdong','广东'
'Guangxi','广西'
'Guizhou','贵州'
'Hainan','海南'
'Hebei','河北'
'Henan','河南'
'Heilongjiang','黑龙江'
'Hubei','湖北'
'Hunan','湖南'
'Jilin','吉林'
'Jiangsu','江苏'
'Jiangxi','江西'
'Liaoning','辽宁'
'Neimenggu','内蒙古'
'Ningxia','宁夏'
'Qinghai','青海'
'Shandong','山东'
'Shanxi','山西'
'Shaanxi','陕西'
'Shanghai','上海'
'Sichuan','四川'
'Tianjin','天津'
'Xizang','西藏'
'Xinjiang','新疆'
'Yunnan','云南'
'Zhejiang','浙江'
'Chongqing','重庆'
'Hong Kong','香港'
'Macau','澳门'
'Taiwan','台湾'
'Anqing','安庆'
'Bangbu','蚌埠'
'Chaohu','巢湖'
'Chizhou','池州'
'Chuzhou','滁州'
'Fuyang','阜阳'
'Huaibei','淮北'
'Huainan','淮南'
'Huangshan','黄山'
'Liuan','六安'
'Maanshan','马鞍山'
'Suzhou','苏州'
'Tongling','铜陵'
'Wuhu','芜湖'
'Xuancheng','宣城'
'Bozhou','亳州'
'Beijing','北京'
'Fuzhou','福州'
'Longyan','龙岩'
'Nanping','南平'
'Ningde','宁德'
'Putian','莆田'
'Quanzhou','泉州'
'Sanming','三明'
'Xiamen','厦门'
'Zhangzhou','漳州'
'Lanzhou','兰州'
'Baiyin','白银市'
'Dingxi','定西'
'Gannan','甘南'
'Jiayuguan','嘉峪关'
'Jinchang','金昌'
'Jiuquan','酒泉'
'Linxia','临夏'
'Longnan','陇南'
'Pingliang','平凉'
'Qingyang','庆阳'
'Tianshui','天水市'
'Wuwei','武威'
'Zhangye','张掖'
'Guangzhou','广州'
'Shenzhen','深圳'
'Chaozhou','潮州'
'Dongguan','东莞'
'Foshan','佛山'
'Heyuan','河源'
'Huizhou','惠州'
'Jiangmen','江门'
'Jieyang','揭阳
'Maoming','茂名'
'Meizhou','梅州'
'Qingyuan','清远'
'Shantou','汕头'
'Shanwei','汕尾'
'Shaoguan','韶关'
'Yangjiang','阳江'
'Yunfu','云浮'
'Zhanjiang','湛江'
'Zhaoqing','肇庆'
'Zhongshan','中山'
'Zhuhai','珠海'
'Nanning','南宁'
'Guilin','桂林'
'Baise','百色市'
'Beihai','北海'
'Chongzuo','崇左'
'Fanggangcheng','防港城'
'Guigang','贵港市'
'Hechi','河池'
'Hezhou','贺州'
'Laibin','来宾市'
'Liuzhou','柳州'
'Qinzhou','钦州'
'Wuzhou','梧州'
'Yulin','玉林'
'Guiyang','贵阳'
'Anshun','安顺'
'Bijie','毕节'
'Liupanshui','六盘水'
'Qiandongnan','黔东南'
'Qiannan','黔南'
'Qianxinan','黔西南'
'Tongren','铜仁市'
'Zunyi','遵义'
'Haikou','海口'
'Sanya','三亚'
'Baisha','白沙'
'Baoting','保亭'
'Changjiang','长江'
'Chengmaixian','澄迈县'
'Dinganxian','定安县'
'Dongfang','东方市'
'Ledong','乐东县'
'Lingao','临高县'
'Lingshui','陵水县'
'Qionghai','琼海市'
'Qiongzhong','琼中县'
'Tunchangxian','屯昌县'
'Wanning','万宁市'
'Wenchang','文昌市'
'Wuzhishan','五指山市'
'Danzhou','儋州市'
'Shijiazhuang','石家庄'
'Baoding','保定'
'Cangzhou','沧州'
'Chengde','承德'
'Handan','邯郸'
'Hengshui','衡水'
'Langfang','廊坊'
'Qinhuangdao','秦皇岛'
'Tangshan','唐山'
'Xingtai','邢台'
'Zhangjiakou','张家口'
'Zhenzhou','真州'
'Luoyang','洛阳'
'Kaifeng','开封'
'Anyang','安阳'
'Hebi','鹤壁'
'Jiyuan','济源'
'Jiaozuo','焦作市'
'Nanyang','南阳市'
'Pingdingshan','平顶山市'
'Sanmenxia','三门峡市'
'Shangqiu','商丘市'
'Xinxiang','新乡市'
'Xinyang','信阳市'
'Xuchang','许昌市'
'Zhoukou','周口市'
'Zhumadian','驻马店市'
'Luohe','漯河市'
'Puyang','濮阳市'
'Harbin','哈尔滨市'
'Daqing','大庆市'
'Greater Higgnan Mountains','大兴安岭'
'Hegang','鹤岗市'
'Heihe','黑河市'
'Jixi','鸡西市'
'Jiamusi','佳木斯市'
'Mudanjiang','牡丹江'
'Qitaihe','七台河'
'Qiqihar','齐齐哈尔'
'Shuang Yashan','双鸭山'
'Suihua','绥化'
'Yichun','宜春'
'Wuhan','武汉'
'Xiantao','仙桃'
'Ezhou','鄂州'
'Huanggang','黄冈'
'Huangshi','黄石'
'Jingmen','荆门'
'Jingzhou','荆州'
'Qianjiang','潜江'
'Shennongjia Forestry District','神农架'
'Shiyan','十堰市'
'Suizhou','随州'
'Tianmen','天门'
'Xianning','咸宁'
'Xiangfan','襄樊'
'Xiaogan','孝感'
'Yichang','宜昌'
'Shien','施恩'
'Changsha','长沙'
'Zhangjiajie','张家界'
'Changde','常德'
'Chenzhou','郴州'
'Hengyang','衡阳'
'Huaihua','怀化'
'Loudi','娄底'
'Shaoyang','邵阳'
'Xiangtan','湘潭'
'Xiangxi','湘西'
'Yiyang','益阳'
'Yongzhou','永州'
'Yueyang','岳阳'
'Zhuzhou','株洲'
'Changchun','长春'
'Jilin','吉林'
'Baicheng','白城'
'Baishan','白山'
'Liaoyuan','辽源'
'Siping','四平'
'Songyuan','松原'
'Tonghua','通化'
'Yanbian','延边'
'Nanjing','南京'
'Suzhou','苏州'
'Wuxi','无锡'
'Changzhou','常州'
'Huaian','淮安'
'Lianyungang','连云港'
'Nantong','南通'
'Suqian','宿迁'
'Taizhou','泰州'
'Xuzhou','徐州'
'Yancheng','盐城'
'Yangzhou','扬州'
'Zhenjiang','镇江'
'Nanchang','南昌'
'Fuzhou','抚州'
'Ganjiang','赣江'
'Ji‘an','吉安'
'Jingdezhen','景德镇'
'Jiujiang','九江'
'Pingxiang','萍乡市'
'Shaorao','上饶市'
'Xinyu','新余市'
'Yichun','宜春市'
'Yingtan','鹰潭市'
'Shenyang','沈阳市'
'Dalian','大连市'
'Anshan','鞍山市'
'Benxi','本溪市'
'Chaoyang','朝阳市'
'Dandong','丹东市'
'Fushun','抚顺市'
'fuxin','阜新市'
'Huludao','葫芦岛'
'Jinzhou','锦州市'
'Liaoyang','辽阳市'
'Panjin','盘锦市'
'Tieling','铁岭市'
'Yingkou','营口市'
'Hohhot','呼和浩特'
'Alax League','阿拉善盟'
'Bayan Nur','巴彦淖尔市'
'Baotou','包头市'
'Chifeng','赤峰市'
'Ordos','鄂尔多斯'
'Hulun Buir','呼伦贝尔'
'Tongliao','通辽市'
'Wuhai','乌海市'
'Ulanqab','乌兰察布市'
'Xilingol League','锡林郭勒盟'
'Hinggan League','兴安盟'
'Yinchun','银川市'
'Guyuan','固原市'
'Shizuishan','石嘴山市'
'Wuzhong','吴忠市'
'Zhongwei','中卫市'
'Xining','西宁市'
'Guoluo','果洛州'
'Tibetan Autonomous Prefecture of Haibei','海北藏族自治州'
'Haidong','海东市'
'Tibetan Autonomous Prefecture of Hainan','海南藏族自治州'
'Haixi Mongolian and Tibetan Autonomous Prefecture','海西蒙古族藏族自治州'
'Tibetan Autonomous Prefecture of Huangnan','黄南藏族自治州'
'Yushu Autonomous Prefecture','玉树藏族自治州'
'Jinan','济南'
'Qingdao','青岛'
'Binzhou','滨州'
'Dezhou','德州'
'Dongying','东营'
'Heze','菏泽'
'Jining','济宁'
'Laiwu','莱芜'
'Liaocheng','聊城'
'Linxia','临沂'
'Rizhao','日照'
'Taian','泰安'
'Weihai','威海'
'Weifang','潍坊'
'Yantai','烟台'
'Zaozhuang','枣庄'
'Zibo','淄博'
'Taiyuan','太原'
'Changzhi','长治'
'Datong','大同'
'Jincheng','晋城'
'Jinzhong','晋中'
'Linfen','临汾'
'Lvliang','吕梁'
'Shuozhou','朔州'
'Xinzhou','忻州'
'Yangguan','阳泉'
'Yuncheng','运城'
'Xi\'an','西安'
'Ankang','安康'
'Baoji','宝鸡'
'Hanzhong','汉中'
'Shangluo','商洛'
'Tongchuan','铜川'
'Weinan','渭南'
'Xianyang','咸阳'
'Yan\'an','延安'
'Yulin','榆林'
'Shanghai','上海'
'Chengdu','成都'
'Mianyang','绵阳'
'Tibetan Qiang Autonomous Prefecture of Ngawa','阿坝藏族羌族自治州'
'Bazhong','巴中'
'Dazhou','达州'
'Deyang','德阳'
'Tibetan Autonomous Prefecture of Garzê','甘孜藏族自治州'
'Guang\'an','广安'
'Guangyuan','广元'
'Leshan','乐山'
'Liangshan','凉山州'
'Meishan','眉山'
'nanchong','南充'
'Neijiang','内江'
'Panzhihua','攀枝花'
'Suining','遂宁'
'Ya\'an','雅安'
'Yibin','宜宾'
'Ziyang','资阳'
'Zigong','自贡'
'Luzhou','泸州'
'Tianjin','天津'
'Lhasa','拉萨'
'Ngari Prefecture','阿里'
'Qamdo','昌都'
'Nyingchi','林芝'
'Nagqu','那曲'
'Shigatse','日喀则市'
'Lhoka','山南市'
'Urumqi','乌鲁木齐'
'Aksu','阿克苏'
'Alaer','阿拉尔'
'Bayingol Mongolian Autonomous Prefecture','巴音郭楞蒙古自治州'
'Bortala Mongol Autonomous Prefecture','博尔塔拉内蒙古自治州'
'Changji hui autonomous prefecture','昌吉回族自治州'
'Hami','哈密市'
'Hotan','和田市'
'Kashgar','喀什地区'
'Karamay','克拉玛依市'
'Kizilsu Kirghiz Autonomous Prefecture','克孜勒苏柯尔克孜自治州'
'Shihezi','石河子'
'Tumu Shuker','图木舒克市'
'Turpan','吐鲁番'
'Wujiaqu','五家渠市'
'Ili Kazak Autonomous Prefecture','伊犁哈萨克自治州'
'Kunming','昆明'
'Nujiang of the Lisu Autonomous Prefecture','怒江傈僳族自治州'
'Puer','普洱'
'Lijiang','丽江'
'Baoshan','保山'
'Chuxiong','楚雄市'
'Dali','大理'
'Dehong','德宏州'
'Diqing','迪庆州'
'Honghe','红河州'
'lincang','临沧'
'Qujing','曲靖'
'Wenshan Zhuang and Miao Autonomous Prefecture','文山壮族苗族自治州'
'Dai Autonomous Prefecture of Xishuangbanna','西双版纳傣族自治州'
'Yuxi','玉溪'
'Shaotong','邵通'
'Hangzhou','杭州'
'Huzhou','湖州'
'Jiaxing','嘉兴'
'Jinhua','金华'
'Lishui','丽水'
'Ningbo','宁波'
'Shaoxing','绍兴'
'Taizhou','台州'
'Wenzhou','温州'
'Zhoushan','舟山'
'Quzhou','衢州'
'CHongqing','重庆'
'Hong Kong','香港'
'Macau','澳门'
'Taiwai','台湾'
'Hefei','合肥'
";
        $p = '/\'(.*?)\',\'(.*?)\'/i';
        preg_match_all($p,$str,$res, PREG_SET_ORDER);*/
        //$transaction = Yii::$app->db->beginTransaction();
        try{
            $model = City::find()->where('p_id=:p_id',[':p_id'=>0])->orderBy('sort asc')->all();
            foreach ($model as $k=> $v){
                    $s_model[$k] = Yii::$app->db->createCommand('select * from `tf_city` where `p_id`=:p_id',[':p_id'=>$v['id']])->queryAll();
                    $city_arr[$k] = [
                        'id' => $v['id'],
                        'city_en' => $v['city_en'],
                        'city_cn' => $v['city_cn'],
                        's_city' => $s_model[$k],
                    ];
            }
            //var_dump($city_arr);die;
            $com = new CommonController();
            $com->dump($city_arr);die;
            /*foreach ($res as $k=>$v)m, {
                $model = City::find()->where('city_en=:city_en',[':city_en'=>$v[1]])->one();
                if($model) {
                    $model->city_cn = $v[2];
                    $model->save();
                }
            }*/
           // $transaction->commit();
        }catch (Exception $e){
            //$transaction->rollBack();
            echo 111;
        }
        die;
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
        $a = yii::$app->db->createCommand("select * from tf_time_test where time1=:time1",array(":time1"=>'-2147483648'))->queryOne();
        echo $a['time'];
        echo "<br>".date("Y-m-d H:i:s",$a['time1']);
        $b = "1901-12-13 20:45:52";
        $c = new \DateTime("1901-12-13 20:45:52");
        echo "<br>".$c->getTimestamp()."<br>";
        $d = new \DateTime();
        $d->setTimestamp($c->getTimestamp());
        echo date("Y-m-d H:i:s",$d->getTimestamp());
        die;
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
