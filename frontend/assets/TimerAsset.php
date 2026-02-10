<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class TimerAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';


    public $js = [
        "https://cdn.rawgit.com/vuejs/vue/v1.0.24/dist/vue.js",
        "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js",
        "js/timer.js"
    ];


    public $depends = [
        'yii\web\YiiAsset',
    ];
}

