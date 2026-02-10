<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchMain backend\models\BannersSearch */
/* @var $searchPage backend\models\BannersSearch */
/* @var $searchModal backend\models\BannersSearch */
/* @var $mainProvider yii\data\ActiveDataProvider */
/* @var $pageProvider yii\data\ActiveDataProvider */
/* @var $modalProvider yii\data\ActiveDataProvider */


$this->title = 'Баннеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-index">


    <?php

    $sortableJs = <<< 'JS'
        sortable('#main_grid tbody', {
        items: 'tr'
    });

       sortable('#page_grid tbody', {
        items: 'tr'
    });
       
      sortable('#modal_grid tbody', {
        items: 'tr'
    });


       sortable('#modal_grid tbody')[0].addEventListener('sortupdate', function (e) {
        let keys = [];
        e.detail.origin.items.forEach(function callback(value, index, array) {
            keys.push($(value).data('key'));
        });
        let url = $('#sort_banners_ajax').val();
        $.post(url, {
            type: 2,
            keys: keys
        }, function (data) {
            console.log(data);
        });
    });   
      
      
      
       sortable('#page_grid tbody')[0].addEventListener('sortupdate', function (e) {
        let keys = [];
        e.detail.origin.items.forEach(function callback(value, index, array) {
            keys.push($(value).data('key'));
        });
        let url = $('#sort_banners_ajax').val();
        $.post(url, {
            type: 1,
            keys: keys
        }, function (data) {
            console.log(data);
        });
    });   
       
    sortable('#main_grid tbody')[0].addEventListener('sortupdate', function (e) {
        let keys = [];
        e.detail.origin.items.forEach(function callback(value, index, array) {
            keys.push($(value).data('key'));
        });
        let url = $('#sort_banners_ajax').val();
        $.post(url, {
            type: 0,
            keys: keys
        }, function (data) {
            console.log(data);
        });
    });
JS;

    $this->registerJs($sortableJs, \yii\web\View::POS_END);
    ?>

    <input type="hidden" id="sort_banners_ajax" value="<?= Url::to(['banners-sort']) ?>"/>

    <p>
        <?= Html::a('Добавить баннер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1>Для главной</h1>
    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $mainProvider,
        'filterModel' => null,
        'columns' => [
            [
                'attribute' => 'href',
                'format' => 'raw',
            ],
            [
                'attribute' => 'image',
                'format'=>'raw',
                'value' => function ($d)  {
                    if ($d->image)
                        return Html::img($d->getThumb(),
                            ['width' => '100px']);
                    else
                        return '';
                },
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ]
        ],
        'options' => ['id' => 'main_grid']
    ]); ?>
    <p>
        <?= Html::a('Добавить баннер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1>Для страницы</h1>
    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $pageProvider,
        'filterModel' => null,
        'columns' => [
            [
                'attribute' => 'href',
                'format' => 'raw',
            ],
            [
                'attribute' => 'image',
                'format'=>'raw',
                'value' => function ($d)  {
                    if ($d->image)
                        return Html::img($d->getThumb(),
                            ['width' => '100px']);
                    else
                        return '';
                },
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ]
        ],
        'options' => ['id' => 'page_grid']
    ]); ?>

    <p>
        <?= Html::a('Добавить баннер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1>Для всплывающих баннеров</h1>
    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $modalProvider,
        'filterModel' => null,
        'columns' => [
            [
                'attribute' => 'href',
                'format' => 'raw',
            ],
            [
                'attribute' => 'image',
                'format'=>'raw',
                'value' => function ($d)  {
                    if ($d->image)
                        return Html::img($d->getThumb(),
                            ['width' => '100px']);
                    else
                        return '';
                },
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Действия',
                'template' => '{update} {delete}',
            ]
        ],
        'options' => ['id' => 'modal_grid']
    ]); ?>
</div>
