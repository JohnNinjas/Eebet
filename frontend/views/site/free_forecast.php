<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 17.09.2019
 * Time: 22:58
 */

/* @var $model \common\models\FreeForecast*/

$this->title = $model->title;
$desc = $model->GetDate().' '.$model->GetTime().', КФ '.$model->odds;
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

            <?php if (!empty($model->tournament)) { ?>
                <div class="articleTournament">
                    <?=$model->tournament?>
                </div>
            <?php } ?>


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
                    Коэф: <?=$model->odds?>
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

       <!--     <div class="bannersBlock">

                <div class="bannersBlockItem bannersBlockItem_1">
                    <a target="_blank" href="http://www.paripartners.ru/C.ashx?btag=a_24468b_1173c_&affid=10644&siteid=24468&adid=1173&c=">
                        <img src="/img/4.png" alt="">
                    </a>
                </div>

                <div class="bannersBlockItem bannersBlockItem_2">
                    <a target="_blank" href="https://track.winline.ru/C.ashx?btag=a_267b_267c_&affid=205&siteid=267&adid=267&c=">
                        <img src="/img/5.png" alt="">
                    </a>
                </div>

                <div class="bannersBlockItem bannersBlockItem_1">
                    <a target="_blank" href="https://aff1xstavka.com/L?tag=s_29891m_1341c_&site=29891&ad=1341">
                        <img src="/img/6.png" alt="">
                    </a>
                </div>

                <div class="bannersBlockItem bannersBlockItem_2">
                    <a target="_blank" href="https://melbetcupis.com/L?tag=s_374449m_10957c_&site=374449&ad=10957">
                        <img src="/img/7.png" alt="">
                    </a>
                </div>

            </div>-->

        </div>

    </div>

</div>
