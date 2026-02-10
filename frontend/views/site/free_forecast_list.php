<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 12.09.2019
 * Time: 14:50
 */


/* @var $this yii\web\View */
$this->title = 'Бесплатные прогнозы';
$this->registerMetaTag(['name' => 'description', 'content' => 'Бесплатные прогнозы']);

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
    'content' => 'Бесплатные прогнозы',
]);


?>



<div class="page">

<div class="headeredPage headeredPage_1">
    <div class="headeredPage__title">
        <img src="/img/headered2.png" alt="">
        <span>Бесплатные прогнозы</span>
    </div>
</div>

<div class="pageContent pageContent__grey pageContent__freeBg">
    <div class="contentWrap">
        <div class="listArticles">
            <?php foreach ($forecasts as $f) : $wait = $f->GetWaitTime(); ?>
            <div class="itemArticles">
                <a href="<?=\yii\helpers\Url::to(['site/free-forecast', 'slug' => $f->slug])?>">
                    <div class="itemArticles__image" style="background-image: url(<?=$f->getThumb()?>)"></div>
                    <div class="itemArticles__info">
                        <div class="itemArticles__title"><?=$f->title?></div>
                        <div class="itemArticles__infoWrap">
                            <div class="articleInfo__date">
                                <div class="articleInfo__date__icon"></div>
                                <?=$f->GetDate()?>
                            </div>
                            <div class="articleInfo__time">
                                <div class="articleInfo__time__icon"></div>
                                <?=$f->GetTime()?>
                            </div>
                            <div class="articleInfo__koef">
                                <div class="articleInfo__koef__icon"></div>
                                Коэф: <?=$f->odds?>
                            </div>

                            <?php if ($wait) : ?>
                                <div class="articleInfo__wait">
                                    <div class="articleInfo__wait__icon"></div>
                                    <?=$wait?>
                                </div>
                            <?php endif; ?>

                            <?php if ($f->expire == 1) : ?>
                                <div class="articleInfo__wait"><div class="articleInfo__wait__icon"></div>Начался</div>
                            <?php endif; ?>

                            <?php if ($f->expire == 2) : ?>
                                <div class="articleInfo__end_bet"><div class="articleInfo__end_bet__icon"></div>Завершен</div>
                            <?php endif; ?>

                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages
    ]); ?>

</div>

</div>
