<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FreeForecast */

$this->title = 'Update Free Forecast: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Free Forecasts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="free-forecast-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
