<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 12.09.2019
 * Time: 14:50
 */

$this->title = 'VIP прогнозы';
$this->registerMetaTag(['name' => 'description', 'content' => 'VIP прогнозы']);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:url',
    'content' => \yii\helpers\Url::canonical(),
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:title',
    'content' => $this->title,
]);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:description',
    'content' => 'VIP прогнозы',
]);

use frontend\assets\TimerAsset;

TimerAsset::register($this);


?>


<input type="hidden" id="timer_date" value="<?=$timerDate?>" />

<div class="page">

    <div class="headeredPage headeredPage_2">
        <div class="headeredPage__title">
            <img src="/img/vip_prognoz.png" alt="">
            <span>VIP прогнозы</span>
        </div>
    </div>

    <div class="pageContent pageContent__grey pageContent__vipBg">
        <div class="contentWrap vip">
            <div class="timer-title text-center">ВНИМАНИЕ! Акция со скидкой 50% закончится ровно через:</div>
            <div class="timer-vip">
                <div id="timer"></div>
            </div>

            <div class="vip-forecast-box">
                <div class="vip-forecast-inner">
                    <?php foreach ($forecasts as $f) : $wait = $f->GetWaitTime(); ?>
                        <a class="vip-forecast" target="_blank" href="https://vk.me/eebet1">
                            <img class="vip-forecast-image" src="<?=$f->getThumb()?>" alt="<?=$f->title?>"/>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]); ?>

        </div>

    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="buy" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="modals">

                </div>
            </div>
        </div>
    </div>
</div>

