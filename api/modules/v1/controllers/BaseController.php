<?php

namespace api\modules\v1\controllers;

use api\models\CommonFunction;
class BaseController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    
    public function checkData(){
      if (isset($_SERVER['HTTP_ORIGIN'])) {
      header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");  //{$_SERVER['HTTP_ORIGIN']}
      header('Access-Control-Allow-Credentials: true');
      header('Access-Control-Max-Age: 86400');    // cache for 1 day
      }

      // Access-Control headers are received during OPTIONS requests
      if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
          if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
              header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

          if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
              header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

          exit(0);
      }
    }


/**
 * 测试接口是否可用
 */
    public function actionShow(){
      $array = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
      return CommonFunction::returnmsg($array);
    }


}
