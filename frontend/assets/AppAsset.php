<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/fonts.css',
        'css/animate.css',
        'css/style.css',
        'css/media.css',
    ];
    
    
    public $js = [
        "js/jquery.waypoints.min.js",
        "js/parallax.min.js",
        "js/js.cookie.min.js",
         "js/common.js"
    ];
    

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
       // 'rmrevin\yii\fontawesome\CdnFreeAssetBundle'
    ];
}
