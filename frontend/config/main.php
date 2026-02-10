<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
   'on beforeRequest' => function ($event) {
        if(!Yii::$app->request->isSecureConnection){
            $url = Yii::$app->request->getAbsoluteUrl();
                $url = str_replace('http:', 'https:', $url);
                Yii::$app->getResponse()->redirect($url);
                Yii::$app->end();
        }
    },
    'language' => 'ru',
    'controllerNamespace' => 'frontend\controllers',
    /*  'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],*/
    'components' => [
        'robokassa' => [
            'class' => '\robokassa\Merchant',
            'baseUrl' => 'https://auth.robokassa.ru/Merchant/Index.aspx',
            'sMerchantLogin' => 'eebet',
            'sMerchantPass1' => 'YIcN7PX2GwnSK14XITD7',
            'sMerchantPass2' => 'gljXIg7492e2fmXDjTXm',
            'isTest' => !YII_ENV_PROD,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            /*'enableStrictParsing' => true,*/
            //'baseUrl' => '',
            'suffix' => '/',
            'rules' => [
                '/' => 'site/index',
                'promotion' => 'site/promotion',
                'contact' => 'site/contact',
                'register' => 'site/signup',
                'privacy' => 'site/privacy',
                'login' => 'site/login',
                'delivery-payment' => 'site/delivery',
                'warranty' => 'site/warranty',
                'free-bet/<slug:[\w\-]+>' => 'site/free-forecast',
                'free-bet/page/<page:\d+>' => 'site/free-forecast-list',
                'free-bet/' => 'site/free-forecast-list',
                'vip-bet/<slug:[\w\-]+>' => 'site/vip-forecast',
                'vip-bet/page/<page:\d+>' => 'site/vip-forecast-list',
                'news-all-cats/page/<page:\d+>' => 'news/news-all-cats',
                'news-all-cats/' => 'news/news-all-cats',
                'news-category/<slug:[\w\-]+>/page/<page:\d+>' => 'news/news-category',
                'news-category/<slug:[\w\-]+>' => 'news/news-category',
                'news/<cat_slug:[\w\-]+>/<slug:[\w\-]+>' => 'news/news',
                '/vip-bet/' => 'site/vip-forecast-list',
                'vote/<id:\d+>/<type:\d+>' => 'news/vote',
                '/vip-bet-photo/<forecast_id:\d+>/<photo:[^\/]+>' => 'photo-secure/vip-forecast-photo',
                '/free-bet-photo/<forecast_id:\d+>/<photo:[^\/]+>' => 'photo-secure/free-forecast-photo',
                '/news-cats-photo/<cat_id:\d+>/<photo:[^\/]+>' => 'photo-secure/news-cats-photo',
                '/news-photo/<news_id:\d+>/<photo:[^\/]+>' => 'photo-secure/news-photo',
            ],
        ],


    ],
    'params' => $params,
];
