<?php
$detail_search = new \frontend\models\DetailsSearchForm();

if (@$mark)
    $detail_search->mark = $mark;

if (@$gen)
    $detail_search->gen = $gen;

if (@$part)
    $detail_search->part = $part;

if (@$child)
    $detail_search->child = $child;


$class =['options' => ['class' => 'soska2']];



?>

<div class="home_slider_form_container text-center">
<?php $form = \yii\bootstrap4\ActiveForm::begin([
    'id' => 'detail_search',
    /*             'fieldConfig' => [
                     'template' => '{label}{input}{hint}{error}',
                     'options' => [
                         'tag' => 'div',
                     ],
                 ],*/
    'enableAjaxValidation' => false,
    'action' => \yii\helpers\Url::to(['/site/details-search-redirect/']),
    'options' => [
        'class' => 'home_search_form d-flex flex-lg-row flex-column align-items-center justify-content-between'
    ]
]); ?>




    <div class="select-box d-flex flex-row align-items-center justify-content-start">

        <?= $form->field($detail_search, 'mark',$class)->widget(\kartik\select2\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\frontend\models\DetailsSearchForm::Marks(), 'id_car_mark', 'name'),
            'options' => ['placeholder' => 'Выберите марку', 'id' => 'mark-id',],
           // 'maintainOrder' => true,
            'pluginOptions' => [
                /* 'allowClear' => true,*/
                'width' => '150px',
            ],
        ])->label(false); ?>
        
        <?= $form->field($detail_search, 'gen')->widget(\kartik\depdrop\DepDrop::classname(), [
            'type' => \kartik\depdrop\DepDrop::TYPE_SELECT2,
            'data' => $detail_search->SetGenList(),
            'options' => ['id' => 'gen-id'],
            //'select2Options'=>['maintainOrder' => true],
            'pluginOptions' => [
                'initialize' => true,
                'depends' => ['mark-id'],
                //'initDepends'=>['mark-id'],
                'placeholder' => 'Выберите модель',
                'url' => \yii\helpers\Url::to(['/site/details-search-gen/'])
            ]
        ])->label(false); ?>


        <?= $form->field($detail_search, 'part')->widget(\kartik\depdrop\DepDrop::classname(), [
            'type' => \kartik\depdrop\DepDrop::TYPE_SELECT2,
            'data' => $detail_search->SetPartList(),
            'options' => ['id' => 'part-id'],
            'select2Options'=>['pluginOptions'=>['maintainOrder' => true]],
            'pluginOptions' => [
                'initialize' => true,
                'depends' => ['gen-id'],
                // 'initDepends'=>['gen-id'],
                'placeholder' => 'Выберите группу',
                'url' => \yii\helpers\Url::to(['/site/details-search-part/']),
                //'params'=>['mark-id']
            ]
            
        ])->label(false); ?>

        <?= $form->field($detail_search, 'child')->widget(\kartik\depdrop\DepDrop::classname(), [
            'type' => \kartik\depdrop\DepDrop::TYPE_SELECT2,
            'data' => $detail_search->SetChildList(),
            'options' => ['id' => 'child-id'],
            'select2Options'=>['pluginOptions'=>['maintainOrder' => true]],
            'pluginOptions' => [
                'initialize' => true,
                'depends' => ['part-id'],
                // 'initDepends'=>['part-id'],
                'placeholder' => 'Выберите деталь',
                'url' => \yii\helpers\Url::to(['/site/details-search-child/']),
                'params'=>['gen-id']
            ],
            'pluginEvents' => [
                "select2:select"=>"function(e) {
                                    if (parseInt(e.params.data['id']) > 0)
                                    $('#detail_search').submit();
                                      }",
            ],
        ])->label(false); ?>

        <?= \yii\helpers\Html::submitButton('Поиск', ['class' => 'home_search_button', 'name' => 'contact-button']) ?>
    </div>
<?php \yii\bootstrap4\ActiveForm::end(); ?>
</div>
