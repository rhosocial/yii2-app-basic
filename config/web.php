<?php

$params = require(__DIR__ . '/params.php');

$db = require(__DIR__ . '/db.php');
if (file_exists(__DIR__ . '/db_local.php')) {
    $db = yii\helpers\ArrayHelper::merge($db, require(__DIR__ . '/db_local.php'));
}

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/models/contact-form' => 'app/models/contact-form.php',
                    ],
                ],
                'user*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@rhosocial/user/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'user' => 'user.php',
                    ],
                ],
                'organization*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@rhosocial/organization/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'organization' => 'organization.php',
                    ],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'app\components\web\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/auth/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'rhosocial\user\rbac\DbManager',
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'admin' =>[
            'class' => 'rhosocial\user\web\admin\Module',
        ],
        'user' => [
            'class' => 'rhosocial\user\web\user\Module',
            'controllerMap' => [
                'my' => [
                    'class' => 'app\controllers\MyController',
                ],
            ],
        ],
        'organization' => [
            'class' => 'rhosocial\organization\web\organization\Module',
        ],
    ],
    'on beforeRequest' => function ($event) {
        $sender = $event->sender;
        /* @var $sender yii\web\Application */
        $sender->language = $sender->request->getPreferredLanguage(['en-US', 'zh-CN']);
        \Yii::trace("Determined language: {$sender->language}", __METHOD__);
    },
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'panels' => [
            'user' => [
                'class' => 'rhosocial\user\debug\panels\UserPanel',
            ],
        ],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
