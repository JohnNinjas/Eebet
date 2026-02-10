<?php
/**
 * @var \common\models\Invoice $model
 */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\InvoiceForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$fieldOptions1 = [
    'template' => '{label}{input}<p class="help-block help-block-error">{hint}</p>'
];

$fieldOptions2 = '<div class="contactForm__checkbox">{beginLabel}{input} <div class="checkboxIndicator"></div><div class="chechboxText">{labelTitle}</div>{endLabel}
<p class="help-block help-block-error">{hint}</p></div>';


?>


<div class="contactForm">
    <div class="contactForm__title">Покупка VIP прогноза <span id="payment_title"></span></div>
    <?php $form = ActiveForm::begin([
        'id' => 'payment-form',
        'fieldConfig' => [
            'template' => '{label}{input}{hint}{error}',
            'options' => [
                'tag' => 'div',
                'class' => 'contactForm__field'
            ],
        ],
        'enableAjaxValidation' => true,
        'action' => \yii\helpers\Url::to(['payment/payment']),
        'options' => [
            'class' => 'promotion-form'
        ]
    ]); ?>
    <?= $form->field($model, 'email', $fieldOptions1)->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'forecast_id')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'price')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'agree', ['labelOptions' => ['label' => $model->getAttributeLabel('agree')],'template' => $fieldOptions2])->checkbox([],false) ?>
    <div class="contactForm__btn text-center">
        <?= Html::submitButton('Купить', ['name' => 'promotion-button']) ?>
    </div>


    <?php ActiveForm::end(); ?>
</div>