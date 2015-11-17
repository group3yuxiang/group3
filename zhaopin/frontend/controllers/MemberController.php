<?php
namespace frontend\controllers;

use Yii;
use frontend\models\member;
use frontend\models\memberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemberController implements the CRUD actions for member model.
 */
class MemberController extends Controller
{
   public function actionIndex(){
       echo 11;
   }
   
   /*
      *登陆的接口
   */

   public function actionLogin(){
       
       $username = $_REQUEST['username']    ?   $_REQUEST['username']   :   '';
       $password = $_REQUEST['password']    ?   $_REQUEST['password']   :   '';
       /*if($username == ""){
           $callback = array(
               'status'     =>  100003,
               'desc'       =>  "用户名不能为空！"
           );
           die;
       }
       if($password == ""){
           $callback = array(
               'status'     =>  100004,
               'desc'       =>  "密码不能为空！"
           );
           die;
       }*/
       $user_info = member::find()->where(['email' => $username])->one(); 
       if($user_info){
           if($user_info['password'] == $password){
               $callbace = array(
                        'status'    =>  200,
                        'desc'      =>  '登陆成功'
                    );
           }else{
               $callbace = array(
                        'status'    =>  100002,
                        'desc'      =>  '密码输入有误！'
                    );
           }
       }else{
           $callbace = array(
                        'status'    =>  100001,
                        'desc'      =>  '用户名不存在！'
                    );
       }
       echo json_encode($callbace);
       
   }

   /*
      *注册接口
   */
   public function actionRegister(){

      $username = trim($_REQUEST['username']);
      $password = trim($_REQUEST['password']);
      $res = member::find()->where(['email' => $username])->one(); 
      if($res){
        $callback = array(
              'status'  =>  '100001',
              'desc'    =>  '用户名已存在！'
          );
        
        exit(json_encode($callback));
      }

      $model = new member();
      $model->email     =   $username;
      $model->password  =   $password;
      $result = $model->insert();
      if($result){
        $callback = array(
              'status'    =>  200,
              'desc'      =>  '注册成功！'
          );
      }else{
        $csllback = array(
              'status'    =>  100002,
              'desc'      =>  '写入失败！'
          );
      }
      echo json_encode($callback);

   }


   /*
      *修改密码的接口
   */

   public function actionChangepwd(){
      $username = trim($_REQUEST['username']);
      $password = trim($_REQUEST['password']);

   }


   /*
      *短信接口方法
   */
    function sendSMS($http,$uid,$pwd,$mobile,$content,$mobileids,$time='',$mid='')
    {

        $data = array
                (
                'uid'=>$uid,          //用户账号
                'pwd'=>md5($pwd.$uid),      //MD5位32密码,密码和用户名拼接字符
                'mobile'=>$mobile,        //号码
                'content'=>$content,      //内容
                'mobileids'=>$mobileids,
                'time'=>$time,          //定时发送
                );
        $re= $this->postSMS($http,$data);     //POST方式提交
        return $re;
    }

    /*
        *短信接口
    */
    
    function postSMS($url,$data='')
    {
            $port="";
            $post="";
            $row = parse_url($url);
            $host = $row['host'];
            @$port = $row['port'] ? $row['port']:80;
            $file = $row['path'];
            while (list($k,$v) = each($data))
            {
                    $post .= rawurlencode($k)."=".rawurlencode($v)."&";
            }
            $post = substr( $post , 0 , -1 );
            $len = strlen($post);
            $fp = @fsockopen( $host ,$port, $errno, $errstr, 10);
            if (!$fp) {
                    return "$errstr ($errno)\n";
            } else {
                    $receive = '';
                    $out = "POST $file HTTP/1.1\r\n";
                    $out .= "Host: $host\r\n";
                    $out .= "Content-type: application/x-www-form-urlencoded\r\n";
                    $out .= "Connection: Close\r\n";
                    $out .= "Content-Length: $len\r\n\r\n";
                    $out .= $post;
                    fwrite($fp, $out);
                    while (!feof($fp)) {
                            $receive .= fgets($fp, 128);
                    }
                    fclose($fp);
                    $receive = explode("\r\n\r\n",$receive);
                    unset($receive[0]);
                    return implode("",$receive);
            }
    }
   
   
   
}
