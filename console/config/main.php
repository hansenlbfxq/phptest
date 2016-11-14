<?php
$baseurl=dirname(__DIR__);
Yii::setAlias('@common',$baseurl."/../common");

$db = require(__DIR__ . '/../../common/config/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'vendorPath'=>"@common/vendor",
    'controllerNamespace' => 'app\controllers',
    'timeZone' => 'Asia/Shanghai',
    
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
];

return $config;
