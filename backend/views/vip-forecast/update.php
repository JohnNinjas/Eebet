<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VipForecast */

$this->title = 'Update Vip Forecast: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Vip Forecasts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vip-forecast-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
