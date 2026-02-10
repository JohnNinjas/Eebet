<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FreeForecast */

$this->title = 'Create Free Forecast';
$this->params['breadcrumbs'][] = ['label' => 'Free Forecasts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="free-forecast-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
