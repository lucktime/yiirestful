<?php

namespace api\modules\v1\controllers;

class RecordController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
