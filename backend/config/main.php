<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'language' => 'ru',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
/*		  'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],*/
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
	'homeUrl' => '/admin',
    'components' => [
        'i18n' => [
            'translations' => [
                'users' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'forceTranslation' => true,
                    'fileMap' => [
                        'users' => 'users.php'
                    ]
                ],
            ],
        ],
    /*    'formatter' => [
            'dateFormat'     => 'php:d-m-Y',
            'datetimeFormat' => 'php:d-m-Y в H:i:s',
            'timeFormat'     => 'php:H:i:s',
        ],*/
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
         'request' => [
            'baseUrl' => '/admin',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
			    '' => 'site/index',
				'accounts' => 'user/index',
				'brands' => 'brand/index',
				'orders' => 'order/index',
				'categories' => 'category/index',
                'parts' => 'parts/index',
				'products' => 'product/index',
                '/details/create/<auto_id:\w+>' => '/details/create',
                '/details/create/<auto_id:\w+>/<clone_id:\d+>' => '/details/create',
               '/details/avito-page/<id:\d+>'=>'/details/avito-page',
                '/details/avito-image-download/<id:\d+>/<num:\d+>'=>'/details/avito-image-download',

             /*   [
                    'pattern' => 'details/create/<auto_id:\w+>/<clone_id:\d+>',
                    'route' => 'details/create',
                    'defaults' => ['auto_id' => '0','clone_id' => 0],
                ],*/



				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        
    ],
    'params' => $params,
];
