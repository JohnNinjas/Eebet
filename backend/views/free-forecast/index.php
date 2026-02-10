<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FreeForecastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Free Forecasts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="free-forecast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Free Forecast', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'odds',
            'image',
            'event_date',
            //'desc:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'pager' => [
        	'firstPageLabel' => 'Первая',
        	'lastPageLabel' => 'Последняя',
		]
    ]); ?>
</div>
