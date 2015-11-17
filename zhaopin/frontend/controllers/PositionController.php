<?php

namespace frontend\controllers;
use app\models\Positions;

class PositionController extends \yii\web\Controller
{
    /*public function actionIndex()
    {
        return $this->render('index');
    }*/
    
    /*
     * 获取职业列表
     */
    public function actionGetlist(){
        $request = \Yii::$app->request;
        /*if( $request->get('appid') != md5('zhaopin') ){
            $data['status'] = 3;
            $data['desc']   = 'appid错误';
            return json_encode($data);
        }*/
        $list = Positions::find()->where('pid=0')->asArray()->all();
        $positionList = array();
        $i = 0;
        
        foreach ( $list as $val ){
            $positionList[$i][0] = $val;
            $positionList[$i]['child_position'] = Positions::find()->where('pid='.$val['id'])->asArray()->all();
            
            $j = 0;
            foreach( $positionList[$i]['child_position'] as $val ){

                $positionList[$i]['child_position'][$j]['child_position'] = Positions::find()->where('pid='.$val['id'])->asArray()->all();
                $j++;
            }
            $i++;
        }
        print_r($positionList);die;
        return json_encode($positionList);
    }

}
