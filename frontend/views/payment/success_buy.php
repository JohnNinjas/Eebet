<?php


/* @var $this yii\web\View */
/* @var $model \common\models\Invoice */
/* @var $forecast \common\models\VipForecast */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$fieldOptions1 = [
    'template' => '{label}{input}<p class="help-block help-block-error">{hint}</p>'
];

$fieldOptions2 = '<div class="contactForm__checkbox">{beginLabel}{input} <div class="checkboxIndicator"></div><div class="chechboxText">{labelTitle}</div>{endLabel}
<p class="help-block help-block-error">{hint}</p></div>';


$this->title = 'Завершение покупки VIP прогноза';
$this->registerMetaTag(['name' => 'description', 'content' => 'Завершение покупки VIP прогноза']);

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
    'content' => 'Завершение покупки VIP прогноза',
]);

$wait = $forecast->GetWaitTime();


?>


<?=Yii::$app->request->hostInfo?>/img/bg_content.png


<div class="page success-page">

    <div class="headeredPage headeredPage_3 headeredPage__acc">
        <div class="headeredPage__title success-buy-head">
            <span>Завершение покупки VIP прогноза</span>
        </div>
    </div>

    <div class="pageContent promo_bg">

        <div class="bg_image">
            <div class="container-new">

                <div class="success-buy text-center">Вы купили VIP прогноз</div>
                <div class="forecast-info">
                    <div class="itemArticles__image" style="background-image: url(<?=Yii::$app->request->hostInfo.$forecast->getPhoto()?>)"></div>
                    <div class="itemArticles__info vip">
                        <div class="itemArticles__title text-center"><?=$forecast->title?></div>
                        <div class="itemArticles__infoWrap">
                            <div class="articleInfo__date">
                                <div class="articleInfo__date__icon"></div>
                                <?=$forecast->GetDate()?>
                            </div>
                            <div class="articleInfo__time">
                                <div class="articleInfo__time__icon"></div>
                                <?=$forecast->GetTime()?>
                            </div>
                            <div class="articleInfo__koef">
                                <div class="articleInfo__koef__icon"></div>
                                Коэф: <?=$forecast->odds_from?> - <?=$forecast->odds_to?>
                            </div>
                            <?php if ($wait) : ?>
                                <div class="articleInfo__wait">
                                    <div class="articleInfo__wait__icon"></div>
                                    <?=$wait?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <div class="buy-text articleText"><?=$forecast->desc?></div>

                <div class="buyer-info">
                    <div class="text">Прогноз выслан на ваш E-mail:</div>
                    <div class="buyer-email"><?=$model->email?></div>
                </div>
                <?php
               /* echo '<pre style="color:red;">';
                print_r($model->attributes);
                print_r($forecast->attributes);
                echo '</pre>';*/
                ?>

            </div>
        </div>

    </div>

</div>
