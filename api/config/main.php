<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
          'csrfParam' => '_csrf-api',
          'parsers' => [
              'application/json' => 'yii\web\JsonParser',
          ],
            // 'cookieValidationKey' => 'w3BnewAWmCrjijzkiLucYD5Ty1Ym_V9F',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=pocket_It',   //数据库hyii2
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        // 'db2' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=127.0.0.1;dbname=bntake-samecity',     //数据库hyii
        //     'username' => 'root',
        //     'password' => '',
        //     'charset' => 'utf8',
        // ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
              ['class' => 'yii\rest\UrlRule', 'controller' =>  ['v1/pocket'],],
            ],
        ],
    ],
    'modules' => [
      'api-v1' => [
         'class' => 'api\modules\v1\Module',
      ],
   ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'allowedIPs' => ['*'],
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'allowedIPs' => ['*'], // 按需调整这里
        'class' => 'yii\gii\Module',
        'generators' => [
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' => [
//                     'adminlte' => '..\..\vendor\yiisoft\yii2-gii\generators\model\adminlte',
                    'adminlte' => '../../vendor/yiisoft/yii2-gii/generators/model/adminlte',
                ]
            ],
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
//                     'adminlte' => '..\..\vendor\yiisoft\yii2-gii\generators\crud\adminlte',
                    'adminlte' => '../../vendor/yiisoft/yii2-gii/generators/crud/adminlte',
                ]
            ],
        ]
    ];
}

return $config;
