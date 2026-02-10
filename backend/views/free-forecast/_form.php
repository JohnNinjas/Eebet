<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use kartik\touchspin\TouchSpin;
use dosamigos\tinymce\TinyMce;

/* @var $model common\models\FreeForecast */

$preview = [];
$preview_cfg = [];
$url = \yii\helpers\Url::to(['photo-delete']);

if (!$model->isNewRecord and $model->image != '') {
    $preview[] = $model->getPhoto();
    $pp['key'] = $model->id;
    $pp['url'] = $url;

    $preview_cfg[] = $pp;
    $plugin = [
        'pluginOptions' => [
            'maxFileCount' => 1,
            'initialPreviewAsData' => true,
            'initialPreview' => $preview,
            'initialPreviewConfig' => $preview_cfg,
            'overwriteInitial' => false,
            'showUpload' => true
        ],
        'pluginEvents' => [
            "filepredelete" => "function(event, key, jqXHR, data) {
         var abort = true; if (confirm('Точно удалить?')) { abort = false; } return abort; 
                }",
        ],
    ];
}
else
    $plugin = [
        'pluginOptions' => [
            'previewFileType' => 'jpg'
        ],
    ];
/* @var $this yii\web\View */
/* @var $model common\models\FreeForecast */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="free-forecast-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tournament')->textInput(['maxlength' => true]) ?>

    <div style="width:200px;">
    <?=  $form->field($model, 'odds')->widget(TouchSpin::classname(), [
        'pluginOptions' => [
            'initval' => 1.00,
            'min' => 0.01,
            'max' => 1000,
            'step' => 0.01,
            'decimals' => 2,
            'boostat' => 10,
            'maxboostedstep' => 10,
        ],
    ]); ?>
    </div>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), $plugin)->label($model->getAttributeLabel('image')) ?>

    <?= $form->field($model, 'event_date')->widget(\kartik\datetime\DateTimePicker::classname(), [
        'options' => [
            'autocomplete' => 'off',
        ],
        'type' => \kartik\datetime\DateTimePicker::TYPE_INPUT,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-mm-yyyy hh:ii'
        ]
    ]); ?>

    <?= $form->field($model, 'desc')->widget(TinyMce::className(), [
        'options' => ['rows' => 10],
        'language' => 'ru',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "image imagetools insertdatetime media table contextmenu paste"
            ],

            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            'image_advtab' => true,
            'image_title' => true,
            'images_upload_url'=>\yii\helpers\Url::to(['/site/tiny-mce-upload']),
            'file_picker_types'=>'image',

        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
