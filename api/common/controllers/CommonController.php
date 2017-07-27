<?php
namespace api\common\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

class CommonController extends Controller
{
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
            echo 'guest';
        }else{
            echo 'loading';
        }
    }

    public $deep = 0;
    public function dump($arr){
        echo '<pre style="margin: 5px auto">';
        if(is_array($arr)){
            $c = count($arr);
            $space = '';
            for ($i=0;$i<$this->deep;$i++){
                $space .= '    ';
            }
            echo $space.'<b>array</b><i>(size='.$c.')</i><br>';
            foreach ($arr as $k => $v){
                $types = gettype($k);
                if($types == 'integer')
                    echo $space.'    '.$k.' => ';
                else
                    echo $space."    '".$k."' => ";
                if(is_array($v)){
                    $this->deep++;
                    $this->dump($v);
                }else{
                    $types = gettype($v);
                    if($types == 'integer' || $types == 'int')
                        echo "int ".$v."<br>";
                    elseif($types == "NULL")
                        echo "<i>".$types."</i><br>";
                    else
                        echo $types." '".$v."'<br>";
                }
            }
            $this->deep--;
        }else{
            echo $arr;
        }
        echo '</pre>';
        die;
    }
}