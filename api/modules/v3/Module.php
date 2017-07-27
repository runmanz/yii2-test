<?php
namespace api\modules\v3;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\v3\controllers';

    public function init(){
        parent::init();
        //\Yii::configure($this, require(Yii::getAlias('@api'). '/config/main.php'));
    }
}