<?php

namespace api\modules\v1\controllers;

use api\modules\v1\controllers\BaseController;
class SpecialtyController extends BaseController
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
