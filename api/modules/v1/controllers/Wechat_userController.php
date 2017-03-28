<?php

namespace api\modules\v1\controllers;

class Wechat_userController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
