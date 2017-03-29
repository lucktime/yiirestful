<?php

namespace api\models;
use Yii;

/**
 * This is the model class for table "wechat_user".
 *
 * @property int $id
 * @property string $openid
 * @property string $nickname 微信昵称
 * @property int $sex 性别
 * @property string $headimgurl 头像
 * @property string $country 国家
 * @property string $province 省份
 * @property string $city 城市
 * @property string $3rd_session
 * @property string $created_at
 * @property int $role 角色(1 企业，2个人，99后台管理员)
 */
require_once 'aes/wxBizDataCrypt.php';
class Wechat_user extends \yii\db\ActiveRecord
{
    public $code;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid', 'nickname', 'sex', 'headimgurl', 'country', 'province', 'city', '3rd_session'], 'required'],
            [['sex', 'role'], 'integer'],
            [['created_at'], 'safe'],
            [['openid', 'headimgurl', '3rd_session'], 'string', 'max' => 255],
            [['nickname', 'country', 'province', 'city'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => 'Openid',
            'nickname' => '微信昵称',
            'sex' => '性别',
            'headimgurl' => '头像',
            'country' => '国家',
            'province' => '省份',
            'city' => '城市',
            '3rd_session' => '3rd Session',
            'created_at' => 'Created At',
            'role' => '角色(1 企业，2个人，99后台管理员)',
        ];
    }
    public function define_str_replace($data){
      return str_replace(' ','+',$data);
    }

    // 获取微信的用户信息（openid）
    public function getUserInfo($code,$encryptedData,$iv){
        //获取微信系统参数
        $appid = Yii::$app->params['wx']['appid'];
        $appsecret = Yii::$app->params['wx']['secret'];
        $user_info_url = Yii::$app->params['wx']['url'];

        $iv = Wechat_user::define_str_replace($iv);  //把空格转成+
        $encryptedData = urldecode($encryptedData);   //解码
        $code = Wechat_user::define_str_replace($code); //把空格转成+
        //从微信获取session_key
        $user_info_url = sprintf("%s?appid=%s&secret=%s&js_code=%s&grant_type=%",$user_info_url,$appid,$appsecret,$js_code,$grant_type);
        $weixin_user_data = json_decode(file_get_contents($user_info_url));
        // $session_key= define_str_replace($user_data->session_key);
        $session_key = $weixin_user_data->session_key;

        //返回结果 解密数据
        $data="";
        $wxBizDataCrypt=new \WXBizDataCrypt($appid,$session_key);
        $errCode=$wxBizDataCrypt->decryptData($encryptedData,$iv,$data);
        return ['errCode'=>$errCode,'data'=>json_decode($data),'session_key'=>$session_key];
    }


    public function login(){
      return true;
      // if ($this->validate()) {
      // Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
      // return $this->getUser();
      // } else {
      // return false;
      // }
    }
}
