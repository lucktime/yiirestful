<?php
namespace tests\models;

use api\models\Wechat_user;
use yii;

class Wechat_userTest extends \Codeception\Test\Unit
{
    public function testgetPerOrEnterInfo(){
    $distance = Wechat_user::getPerOrEnterInfo('abc123','1');
    codecept_debug($distance);
    // codecept_debug("lat: {$addGeo['lat']}");
    // codecept_debug("lng: {$addGeo['lng']}");
    }

}
