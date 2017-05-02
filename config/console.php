<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
if (file_exists(__DIR__ . '/db_local.php')) {
    $db = yii\helpers\ArrayHelper::merge($db, require(__DIR__ . '/db_local.php'));
}

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'language' => 'zh-CN',
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
        'authManager' => [
            'class' => 'rhosocial\user\rbac\DbManager',
        ],
        'db' => $db,
    ],
    'params' => $params,
    
    'controllerMap' => [
        /*
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
         */
        'user' => [
            'class' => 'rhosocial\user\console\controllers\UserController',
            'userClass' => 'app\models\User',
        ],
        'organization' => [
            'class' => 'rhosocial\organization\console\controllers\OrganizationController',
            'userClass' => 'app\models\User',
            'organizationClass' => 'app\models\organization\Organization',
        ],
    ],
    
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
