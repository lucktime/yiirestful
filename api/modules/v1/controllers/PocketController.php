<?php

namespace api\modules\v1\controllers;

use api\modules\v1\controllers\BaseController;
use api\models\CommonFunction;

class PocketController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }


}
