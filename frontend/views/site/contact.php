<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты — SmolAR';
$this->registerMetaTag(['name' => 'description', 'content' => 'Контакты авторазборки «SmolAR» в Смоленске: адрес, телефон и часы работы. Форма обратной связи для уточнения информации по авто запчастям и выкупу автомобилей.']);



$fieldOptions1 = [
    'template' => '<div class="form_title">{label}</div>{input}<p class="help-block help-block-error">{hint}</p>'
];

/*$fieldOptions2 = [
    'template' => '<div class="form_title">{label}{input}</div><p class="help-block help-block-error">{hint}</p>'
];*/


/* $form->field($model, 'verifyCode')->widget(Captcha::className(), [
    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
    'options' => ['class' => 'comment_input'],
]) */


?>



<div class="home contact-page">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li>Контакты</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact">


    <div class="contact_map">

        <div class="map">
            <div id="yandex_map">
                <div class="map_container">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ah8g2AJSeKQlLyjYOPxu14XdsgHy6O2KO&amp;width=100%25&amp;height=370&amp;lang=ru_RU&amp;scroll=false"></script>
                </div>
            </div>
        </div>
    </div>


        <div class="contact_info_container">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="contact_form">
                            <div class="contact_info_title">Обратная связь</div>

                            
                            <?php $form = ActiveForm::begin([
                                'id' => 'contact-form',
                                'fieldConfig' => [
                                    'template' => '{label}{input}{hint}{error}',
                                  /*  'horizontalCssClasses' => [
                                        'label' => '',
                                        'offset' => '',
                                        'wrapper' => '',
                                        'error' => '.wpcf7-not-valid-tip',
                                        'hint' => '',
                                    ],*/
                                    'options' => [
                                        'tag' => 'div',
                                    ],
                                ],
                                'enableAjaxValidation' => false,
                                'options' => [
                                    'class' => 'comment_form'
                                ]
                            ]); ?>
                            
                            <?= $form->field($model, 'name', $fieldOptions1)->textInput(['autofocus' => true,'class' => 'comment_input']) ?>

                            <?= $form->field($model, 'email', $fieldOptions1)->textInput(['class' => 'comment_input']) ?>
                            
                            <?= $form->field($model, 'body', $fieldOptions1)->textarea(['class' => 'comment_input comment_textarea','rows' => 6]) ?>

                            <?= $form->field($model, 'private')->checkbox(['label' => $model->getAttributeLabel('private')]) ?>


                            <div class="form-group">
                                <?= Html::submitButton('Отправить', ['class' => 'comment_button trans_200', 'name' => 'contact-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="contact_info">
                            <h1 class="contact_info_title">Контакты</h1>
                            <div class="contact_info_location">
                                <ul class="location_list">
                                    <li>Наш адрес г. Смоленск, пос. Серебрянка, д.84к1</li>
                                    <li>Телефон отдела продаж <a class="phone" href="tel:+79203022294">8(920)302-22-94</a></li>
                                    <li>Пн-Пт 10:00 - 17:00</li>
                                    <li>Электронный ящик: zap@smolar.ru</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

