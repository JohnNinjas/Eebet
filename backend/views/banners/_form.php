<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $model common\models\Banners */

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
/* @var $model common\models\Banners */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banners-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->radioList(['Для главной','Для прогноза','Всплывающий баннер по центру']) ?>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), $plugin)->label($model->getAttributeLabel('image')) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
