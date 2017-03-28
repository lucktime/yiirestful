<?php

namespace api\modules\v1\controllers;

class PocketController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionShow()
    {
        return "123";
    }


}
