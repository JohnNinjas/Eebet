<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\VipForecast */

$this->title = 'Create Vip Forecast';
$this->params['breadcrumbs'][] = ['label' => 'Vip Forecasts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-forecast-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
