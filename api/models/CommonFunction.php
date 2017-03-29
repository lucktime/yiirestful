<?php

namespace api\models;
use Yii;
use yii2mod\enum\helpers\BaseEnum;

class CommonFunction
{

/**
 * 返回json格式的自定义
 */
  public function returnmsg($array){

    return \Yii::createObject([
      'class' => 'yii\web\Response',
      'format' => \yii\web\Response::FORMAT_JSON,
      'data' => [
          'status' => '1',
          'message' => 'hello world',
          'data' => $array,
        ],
    ]);
  }


  //json方法
    public function returnjson($code = 200,$status = 1, $msg = '加载成功',$data = []) {
      if ($status == 1) {
        return \Yii::createObject([
          'class' => 'yii\web\Response',
          'format' => \yii\web\Response::FORMAT_JSON,
          'data' => [
              'code' => $code,
              'message' => $msg,
              'data' => $data,
            ],
        ]);
      } else {
        return \Yii::createObject([
          'class' => 'yii\web\Response',
          'format' => \yii\web\Response::FORMAT_JSON,
          'data' => [
              'errcode' => $code,
              'message' => $msg,
              'fields' => "returnjson",
            ],
        ]);
      }


    }
}
