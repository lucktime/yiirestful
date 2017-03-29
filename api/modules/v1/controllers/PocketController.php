<?php

namespace api\modules\v1\controllers;

use Yii;
use Swagger\Annotations as SWG;
use api\modules\v1\controllers\BaseController;
use api\models\CommonFunction;

class PocketController extends BaseController
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGenswg(){

      $projectRoot = Yii::getAlias('@api');
      // require("vendor/autoload.php");
      // $swagger = \Swagger\scan($projectRoot);
      // header('Content-Type: application/json');
      // echo $swagger;


      $swagger = \Swagger\scan($projectRoot);
      $json_file = $projectRoot . '/web/swagger-docs/swagger.json';
        // return $json_file;
      $is_write = file_put_contents($json_file, $swagger);
      if ($is_write == true) {
          $this->redirect('/swagger-ui/dist/index.html');
      }
  }
}
