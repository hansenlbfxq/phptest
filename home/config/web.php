<?php
$baseurl=dirname(__DIR__);
Yii::setAlias('@common',$baseurl."/../common");
$locale = isset($_COOKIE['language'])?$_COOKIE['language']:"zh";

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log'
    ],
    'vendorPath'=>"@common/vendor",
    'defaultRoute' => 'site/index',//默认控制器
    'language' => 'zh',
    'timeZone' => 'Asia/Shanghai',

    // behavior  处理语言选择
    'on beforeRequest' => function ($event) {
        $locale = isset($_COOKIE['language'])?$_COOKIE['language']:"zh";
        Yii::$app->sourceLanguage = 'en';
        Yii::$app->language = $locale ;
        return; 
    },
    

    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'testas',
            'enableCsrfValidation' => false   //跨域提交问题
            ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' =>'@app/views/'.$locale,//实际模板路径
                ],
            ],
        ],
        'user' => [
             'identityClass' => '',
             'enableAutoLogin' => false
         ],
        'cache' => [
            'class' => 'yii\caching\FileCache'
        ],
        'errorHandler' => [
            'errorAction' => 'error/index'
        ],
        'assetManager'=>[
            'bundles' => [
                            'yii\web\JqueryAsset' => [
                                'js'=>[]
                            ],
                            'yii\bootstrap\BootstrapPluginAsset' => [
                                'js'=>[]
                            ],
                            'yii\bootstrap\BootstrapAsset' => [
                                'css' => [],
                            ],
                    
                        ]
        
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ]
                ],
                [
                'class' => 'yii\log\FileTarget',
                'logVars'=>[],//日志中追加的变量
                'levels' => [
                    'info'
                ],
                'categories' => [
                    'sql'  //支付请求日志
                ],
                'logFile' => '@app/runtime/logs/sql.log',
                'maxFileSize' => 1024 * 2,
                'maxLogFiles' => 20
                ],
                
                
            ]
        ],
        'db' => require (__DIR__ . '/../../common/config/db.php'),

        'mailer' => [  
           'class' => 'yii\swiftmailer\Mailer',  
            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [  
                   'class' => 'Swift_SmtpTransport',  
                   'host' => 'smtp.126.com',  //每种邮箱的host配置不一样
                   'username' => 'hansen102030@126.com',  
                   'password' => '1q2w3e',  
                   'port' => '25',  
                   //'encryption' => 'tls',  
                                   
            ],   
            'messageConfig'=>[  
               'charset'=>'UTF-8',  
               'from'=>['hansen102030@126.com'=>'admin']  
            ],  
        ],  

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ]
        ],

    ],
    'params' => require (__DIR__ . '/../../common/config/params.php'),

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module'
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module'
    ];
}

return $config;
