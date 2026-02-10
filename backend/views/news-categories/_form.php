<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use kartik\touchspin\TouchSpin;
use dosamigos\tinymce\TinyMce;

/* @var $model common\models\NewsCategories */
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

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

?>

<div class="free-forecast-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'file')->widget(FileInput::classname(), $plugin)->label($model->getAttributeLabel('image')) ?>
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
