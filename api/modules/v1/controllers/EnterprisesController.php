<?php

namespace api\modules\v1\controllers;

class EnterprisesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
