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




?>

<div class="page">

    <div class="headeredPage headeredPage_3 headeredPage__acc">
        <div class="headeredPage__title">
            <span>Завершение покупки VIP прогноза</span>
        </div>
    </div>

    <div class="pageContent promo_bg">

        <div class="bg_image">
            <div class="container-new">

                <?php
                echo '<pre style="color:red;">';
                print_r($model->attributes);
                print_r($forecast->attributes);
                echo '</pre>';
                ?>

            </div>
        </div>

    </div>

</div>
