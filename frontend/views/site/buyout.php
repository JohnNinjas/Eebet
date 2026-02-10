<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Buyout;
use common\widgets\Alert;

$this->title = 'Выкуп авто в Смоленске – срочно, дорого!';
$this->registerMetaTag(['name' => 'description', 'content' => 'Срочный выкуп автомобилей в Смоленске по лучшим ценам от компании SmolAR. За час купим дорого ваш авто: на ходу, либо после ДТП. Звоните и записывайтесь на осмотр!']);

$fieldOptions1 = [
    'template' => '<div class="form_title">{label}</div>{input}<p class="help-block help-block-error">{hint}</p>'
];


$cfg = [
    'showPreview' => true,
    'showCaption' => true,
    'showRemove' => false,
    'showUpload' => false,
    'initialPreviewAsData' => true,
    'layoutTemplates' => ['actions' => '']
];

?>


<div class="home contact-page">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li>Выкуп авто</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact">
    <div class="contact_info_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?= Alert::widget() ?>
                    <h1 class="contact_info_title text-center">Выкуп авто</h1>
                    <?php $form = ActiveForm::begin([
                        'id' => 'buyout-form',
                        'fieldConfig' => [
                            'template' => '{label}{input}{hint}{error}',
                            'options' => [
                                'tag' => 'div',
                                'class' => 'buyout-input'
                            ],
                        ],
                        'enableAjaxValidation' => false,
                        'options' => [
                            'class' => 'comment_form'
                        ]
                    ]); ?>


                    <div class="row">
                        <div class="col-lg-4">
                            <?= $form->field($model, 'model', $fieldOptions1)->textInput(['class' => 'comment_input']) ?>

                            <?= $form->field($model, 'name', $fieldOptions1)->textInput(['autofocus' => true, 'class' => 'comment_input']) ?>

                            <?= $form->field($model, 'phone', $fieldOptions1)->textInput(['class' => 'comment_input']) ?>

                            <?= $form->field($model, 'price', $fieldOptions1)->textInput(['class' => 'comment_input']) ?>

                            <?= $form->field($model, 'year', $fieldOptions1)->textInput(['class' => 'comment_input']) ?>

                            <?= $form->field($model, 'vin', $fieldOptions1)->textInput(['class' => 'comment_input']) ?>

                            <?= $form->field($model, 'city', $fieldOptions1)->textInput(['class' => 'comment_input']) ?>

                            <?= $form->field($model, 'engine', $fieldOptions1)->textInput(['class' => 'comment_input']) ?>

                            <?= $form->field($model, 'body', $fieldOptions1)->textInput(['class' => 'comment_input']) ?>

                        </div>

                        <div class="col-lg-8">

                            <?= $form->field($model, 'engine_type', $fieldOptions1)->dropDownList(Buyout::getTypes('engine_type'), ['class' => 'comment_input', 'prompt' => 'Выберите']) ?>

                            <?= $form->field($model, 'gear_type', $fieldOptions1)->dropDownList(Buyout::getTypes('gear_type'), ['class' => 'comment_input', 'prompt' => 'Выберите']) ?>

                            <?= $form->field($model, 'transmission_type', $fieldOptions1)->dropDownList(Buyout::getTypes('transmission_type'), ['class' => 'comment_input ', 'prompt' => 'Выберите']) ?>

                            <?= $form->field($model, 'files[]', $fieldOptions1)->widget(\kartik\file\FileInput::classname(), [
                                'options' => ['multiple' => true],
                                'pluginOptions' => $cfg
                            ])->label('Картинки'); ?>

                            <?= $form->field($model, 'text', $fieldOptions1)->textarea(['class' => 'comment_input comment_textarea', 'rows' => 6]) ?>


                            <?= $form->field($model, 'private')->checkbox(['label' => $model->getAttributeLabel('private')]) ?>


                            <div class="form-group">
                                <?= Html::submitButton('Отправить', ['class' => 'comment_button trans_200', 'name' => 'contact-button']) ?>
                            </div>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-lg-12">
                    Если у Вас есть битое, списанное, проблемное авто и Вы хотите его продать, то мы с радостью рассмотрим Ваше предложение. Мы выкупаем авто в Смоленске и области под разбор, документы должны быть обязательно, либо справка о снятии с учёта.
                </div>
            </div>


        </div>
    </div>
</div>


