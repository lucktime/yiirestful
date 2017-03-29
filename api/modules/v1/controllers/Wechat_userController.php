<?php

namespace api\modules\v1\controllers;
use Yii;
use api\models\CommonFunction;
use api\models\Wechat_user;
use api\modules\v1\controllers\BaseController;
class Wechat_userController extends BaseController
{
  //ajax post 请求无法通过导致 400错误
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }


/**
 * 版本功能：微信小程序的登录接口实现。
 * 更新时间：2017年03月29日
 * 参数传递：通过 code,得到openid 和 session_key
 * json 数据返回：eg:$code = 200,$status = 1, $msg = '加载成功',$data = []
 */
    public function actionPocket_login(){
      $model = new Wechat_user();

      //A.用户非第一次登陆

      // 1.非对称加密
      // 2.验证参数是否存在
      // 3.验证数据是否有效
      // 4.登录凭证 code 获取 session_key 和 openid
      $this->checkData();
      $failedCode = 400;
      $failedType = 0;
      $failedmsg = "failed login";

      $successCode = 200;
      $successType = 1;
      $successmsg = "success login";
      // return  $_REQUEST['code'];

      $data = Yii::$app->request->post();
      if (!(isset($data["code"]) && isset($data["iv"]) && isset($data["encryptedData"]))){
          return CommonFunction::returnjson($failedCode,$failedType,$failedmsg.",invalid input",$model);
      }

      // 验证code 是否有效
      if ($data) {
        if (!empty($data['code'])) {
          // $code= $data['code'];
          $js_code = $data['code'];
          $encryptedData = $data['encryptedData'];
          $iv = $data['iv'];

          $msg = Wechat_user::getUserInfo($code,$encryptedData,$iv);
          return json_encode($msg);
          //下面if 循环待测试，未完成。。go on
          if($msg['errCode']==0){
             $open_id=$msg['data']->openId;
             $users_db=D('Users');
             $info=$users_db->getUserInfo($open_id);
             if(!$info||empty($info)){
               $users_db->addUser(['open_id'=>$open_id,'last_time'=>['exp','now()']]); //用户信息入库
               $info=$users_db->getUserInfo($open_id);                  //获取用户信息
               $session_id=`head -n 80 /dev/urandom | tr -dc A-Za-z0-9 | head -c 168`;  //生成3rd_session
               $session_db->addSession(['uid'=>$info['id'],'id'=>$session_id]); //保存session
             }
             if($session_id){
              return CommonFunction::returnjson($successCode,$successType,$successmsg,['sessionid'=>$session_id]);
              //  $this->ajaxReturn(['error_code'=>0,'sessionid'=>$session_id]);  //把3rd_session返回给客户端
             }else{
               $this->ajaxReturn(['error_code'=>0,'sessionid'=>$session_db->getSid($info['id'])]);
             }

           }else{
             return CommonFunction::returnjson($failedCode,$failedType,'用户信息获取失败！',$model);
           }
          }
        }



      // 无用~
      // return $model->load(Yii::$app->request->post());
      // if ($data && $model->login()) {
      //   // $model->openid =
      //    return CommonFunction::returnjson(200,1,"success login",$model);
      // } else {
      //    return CommonFunction::returnjson(404,0,"failed login",$model);
      //   }
    }


}
