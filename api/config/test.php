<?php
$dbParams = require(__DIR__ . '/test_db.php');

return [
    'id' => 'app-backend-tests',
    'components' => [
        'db' => $dbParams,
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
    ],
];
