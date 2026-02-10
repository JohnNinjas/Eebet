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


?>



<div class="page">

    <div class="headeredPage headeredPage_2">
        <div class="headeredPage__title">
            <img src="/img/vip_prognoz.png" alt="">
            <span>VIP прогнозы</span>
        </div>
    </div>

    <div class="pageContent pageContent__grey pageContent__vipBg">
        <div class="contentWrap">
            <div class="listArticles">
                <?php foreach ($forecasts as $f) : $wait = $f->GetWaitTime(); ?>
                <div class="itemArticles">
                    <a target="_blank" href="https://vk.me/eebet1">
                        <div class="itemArticles__image vip" style="background-image: url(<?=$f->getThumb()?>)"></div>
                        <!--   <div class="itemArticles__info vip">
                                    <div class="itemArticles__title text-center"><?/*=$f->title*/?></div>-->
                        <!--<div class="itemArticles__infoWrap">
                                        <div class="articleInfo__date">
                                            <div class="articleInfo__date__icon"></div>
                                            <?/*=$f->GetDate()*/?>
                                        </div>
                                        <div class="articleInfo__time">
                                            <div class="articleInfo__time__icon"></div>
                                            <?/*=$f->GetTime()*/?>
                                        </div>
                                        <div class="articleInfo__koef">
                                            <div class="articleInfo__koef__icon"></div>
                                            Коэф: <?/*=$f->odds_from*/?> - <?/*=$f->odds_to*/?>
                                        </div>

                                        <?php /*if ($wait) : */?>
                                            <div class="articleInfo__wait">
                                                <div class="articleInfo__wait__icon"></div>
                                                <?/*=$wait*/?>
                                            </div>
                                        <?php /*endif; */?>

                                        <?php /*if ($f->expire == 1) : */?>
                                            <div class="articleInfo__wait"><div class="articleInfo__wait__icon"></div>Начался</div>
                                        <?php /*endif; */?>

                                        <?php /*if ($f->expire == 2) : */?>
                                            <div class="articleInfo__end_bet"><div class="articleInfo__end_bet__icon"></div>Завершен</div>
                                        <?php /*endif; */?>
                                    </div>-->
                        <div class="contactForm__inputBtn">
                            <?php if ($f->open == 1) : ?>
                                <a class="buy-href" target="_blank" href="https://vk.com/uslugi-170572400">Купить</a>
                                <!--<a class="buy-href" href="<?/*=\yii\helpers\Url::to(['site/vip-forecast', 'slug' => $f->slug])*/?>">Посмотреть</a>-->
                            <?php else :?>
                                <a class="buy-href" target="_blank" href="https://vk.com/uslugi-170572400">Купить</a>
                                <!--<button class="buy" data-id="<?/*=$f->id*/?>" data-price="<?/*=$f->price*/?>" data-title="<?/*=$f->title*/?>">Купить</button>-->
                            <?php endif ?>
                        </div>
                        <!--          </div>
                      </div>-->
                        <?php endforeach; ?>
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

