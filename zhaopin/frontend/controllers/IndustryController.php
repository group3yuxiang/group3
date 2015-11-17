<?php

namespace frontend\controllers;
use app\models\Industry;
class IndustryController extends \yii\web\Controller
{
    /*
     * 行业信息列表
     */
    public function actionGetlist(){
        $request = \Yii::$app->request;
        /*if( $request->get('appid') != md5('zhaopin') ){
            $data['status'] = 3;
            $data['desc']   = 'appid错误';
            return json_encode($data);
        }*/
        $list = Industry::find()->where('pid=0')->asArray()->all();
        $industryList = array();
        $i = 0;
        foreach ( $list as $val ){
            $industryList[$i][0] = $val;
            $industryList[$i]['child_industry'] = Industry::find()->where('pid='.$val['id'])->asArray()->all();
           
            $i++;
        }
        
        return json_encode($industryList);
       
        
    }
    
}
