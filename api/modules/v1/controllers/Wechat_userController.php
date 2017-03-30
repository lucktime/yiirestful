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
 * @SWG\Post(
 *     path="/wechat_user/pocket_login/{code}/{iv}/{encryptedData}/{user_role}",
 *     description="参数：code，encryptedData，iv,用于Post请求, 登录用户，并返回session_3rd，open_id 给用户,用户将session_id session 派发到小程序客户端之后，可将其存储在 storage ，用于后续通信使用。用于个人登录",
 *     operationId="pocket_login",
 *     @SWG\Parameter(
 *         description="客户端获取，时效5分钟,调用wx.login 会获取到 code",
 *         format="int64",
 *         in="path",
 *         name="code",
 *         required=true,
 *         type="string"
 *     ),
 *   @SWG\Parameter(
 *     name="encryptedData",
 *     in="path",
 *     description="调用wx.getUserInfo 搜索会获取到 encryptedData,需要encodeURIComponent(res.encryptedData)操作再发送",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="iv",
 *     in="path",
 *     description="调用wx.getUserInfo 搜索会获取到 iv",
 *     required=true,
 *     type="string"
 *   ),
 *   @SWG\Parameter(
 *     name="user_role",
 *     in="path",
 *     description="登录用户角色类型 3：个人 4：企业",
 *     required=true,
 *     type="string"
 *   ),
 *     @SWG\Response(
 *         response=200,
 *         description="get open_id And session_3rd"
 *     ),
 *     @SWG\Response(
 *         response=400,
 *         description="unexpected error"
 *     )
 * )
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
      if (!(isset($data["code"]) && isset($data["iv"]) && isset($data["encryptedData"]) && isset($data["user_role"]) )){
          return CommonFunction::returnjson($failedCode,$failedType,$failedmsg.",invalid input",$model);
      }

      // 验证code 是否有效
      if ($data) {
        if (!empty($data['code'])) {
          //得到请求参数
          $js_code = $data['code'];
          $encryptedData = $data['encryptedData'];
          $iv = $data['iv'];
          $user_role = $data['user_role'];

          $msg = Wechat_user::getUserInfo($code,$encryptedData,$iv);
            //  $session_3rd = Yii::$app->getSecurity()->generateRandomString();
            //  return $session_3rd;
          // return json_encode($msg);
          //下面if 循环待测试，未完成。。go on
          if($msg['errCode'] == 0){
             $open_id = $msg['data']->openId;
             $we_user = new Wechat_user();
             // 判断数据库是否存在微信身份下的（个人信息或企业信息）
             $info = $we_user->getPerOrEnterInfo($open_id,$user_role);

             if(!$info||empty($info)){
               
               $users_db->addUser(['open_id'=>$open_id,'last_time'=>['exp','now()']]); //用户信息入库
               $info=$users_db->getUserInfo($open_id);                  //获取用户信息
               $session_id=`head -n 80 /dev/urandom | tr -dc A-Za-z0-9 | head -c 168`;  //生成3rd_session
               $session_3rd = Yii::$app->getSecurity()->generateRandomString();

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
