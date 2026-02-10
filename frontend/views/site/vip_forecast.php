<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 17.09.2019
 * Time: 22:58
 */

/* @var $model \common\models\VipForecast*/

$this->title = $model->title;
$desc = $model->GetDate().' '.$model->GetTime().', КФ '.$model->odds_from.' - '.$model->odds_to;
$this->registerMetaTag(['name' => 'description', 'content' => $desc]);

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
    'content' => $desc,
]);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:image',
    'content' => '/photo.png',
]);



$wait = $model->GetWaitTime();
?>

<div class="page">

    <div class="articleContent">

        <div class="articleContainer">

            <div class="articleImage">
                <img src="<?=$model->getPhoto()?>" alt="">
            </div>

            <div class="articleTitle">
                <?=$model->title?>
            </div>
            <div class="articleInfo">
                <div class="articleInfo__date">
                    <div class="articleInfo__date__icon"></div>
                    <?=$model->GetDate()?>
                </div>
                <div class="articleInfo__time">
                    <div class="articleInfo__time__icon"></div>
                    <?=$model->GetTime()?>
                </div>
                <div class="articleInfo__koef">
                    <div class="articleInfo__koef__icon"></div>
                    Коэф: <?=$model->odds_from?> - <?=$model->odds_to?>
                </div>

                <?php if ($wait) : ?>
                    <div class="articleInfo__wait">
                        <div class="articleInfo__wait__icon"></div>
                        <?=$wait?>
                    </div>
                <?php endif; ?>

                <?php if ($model->expire == 1) : ?>
                    <div class="articleInfo__wait">
                        <div class="articleInfo__wait__icon"></div>
                        Начался
                    </div>
                <?php endif; ?>

                <?php if ($model->expire == 2) : ?>
                    <div class="articleInfo__end_bet"><div class="articleInfo__end_bet__icon"></div>Завершен</div>
                <?php endif; ?>

            </div>
            <div class="articleText">
                <?=$model->desc?>
            </div>


            <div class="index-banner-block"><?foreach ($banners as $b) : ?><a href="<?=$b->href?>" target="_blank"><img src="<?=$b->getThumb()?>" /></a><?endforeach;?></div>

        </div>

    </div>

</div>
