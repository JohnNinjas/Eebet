<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

/* @var $this yii\web\View */
$this->title = 'Ставки на спорт';
$this->registerMetaTag(['name' => 'description', 'content' => 'Ставки на спорт']);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:url',
    'content' => \yii\helpers\Url::canonical(),
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:title',
    'content' => 'Главная',
]);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:description',
    'content' => 'Ставки на спорт',
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:image',
    'content' => '/photo.png',
]);







?>


<div class="screensWrap">

    <div class="screenItem screenHeader parallax-window" data-ios-disabled="false" data-android-disabled="false" data-parallax="scroll" data-image-src="img/first.jpg">

        <div class="screenHeader__logo">
            <img src="img/logo.png" alt="">
        </div>
        <div class="screenHeader__title animated fadeInRight">
            Ваш успех - наша работа!
        </div>
        <div class="screenHeader__description animated fadeInRight">
            Предлагаем результативные прогнозы по направлениям:
            футбол, теннис, хоккей, снукер, дартс, волейбол, баскетбол и многое другое
        </div>
        <div class="screenHeader__btn animated fadeInDown">
            <a class="btn__yellow_lighter" href="#go_index">Подробнее</a>
        </div>

    </div>

    <a class="anchor" id="director"></a>
    <div class="screenItem screenItem_director anchor" id="screenItem_director">

        <div class="container-new">

            <div class="wrap-row ai_center">

                <div class="messageDirectorWrap">
                    <img src="img/text.png" alt="">
                </div>
                <div class="photoDirectorWrap">
                    <div class="photoDirector"></div>
                </div>

            </div>

        </div>

    </div>

    <div id="screenItem_why" class="screenItem parallax-window screenItem_why" data-ios-disabled="false" data-android-disabled="false" data-parallax="scroll" data-image-src="img/bg_2.jpg">
        <div class="container-new">
            <div class="wrap-row ai_center">

                <div class="title_image">
                    <div class="title_image__text">
                        Почему мы лучшие?!
                    </div>
                </div>

                <div class="text_section hiddenText">
                    Сейчас EEBET - это опытная команда профессионалов,
                    <br>
                    которая ежедневно просматривает всевозможные матчи,
                    <br>
                    выявляя сильные и слабые стороны отдельных игроков и команд.
                    <br>
                    Каждый специалист проводит
                    <br>
                    всестороннюю спортивную аналитику
                    <br>
                    в своем направлении и выдает результативные прогнозы,
                    <br>
                    позволяющие процветать нашим клиентам!
                </div>

                <div class="iconsWrap">
                    <div class="iconItem">
                        <img src="img/icon1.png" alt="">
                        <p>Доступная <br> цена</p>
                    </div>
                    <div class="iconItem">
                        <img src="img/icon2.png" alt="">
                        <p>Огромный <br> опыт</p>
                    </div>
                    <div class="iconItem">
                        <img src="img/icon3.png" alt="">
                        <p>Тысячи <br> отзывов</p>
                    </div>
                    <div class="iconItem">
                        <img src="img/icon4.png" alt="">
                        <p>Стабильный <br> заработок</p>
                    </div>
                    <div class="iconItem">
                        <img src="img/icon5.png" alt="">
                        <p>Прозрачная <br>статистика</p>
                    </div>
                    <div class="iconItem">
                        <img src="img/icon6.png" alt="">
                        <p>Экономия <br> времени</p>
                    </div>
                    <div class="iconItem">
                        <img src="img/icon7.png" alt="">
                        <p>Качественный <br> анализ</p>
                    </div>
                    <div class="iconItem">
                        <img src="img/icon8.png" alt="">
                        <p>Высокие <br> коэффиценты</p>
                    </div>
                </div>

            </div>
        </div>

        <svg class="svg__bottom" style="height:4vw;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 200" preserveAspectRatio="none"> <path d="M640 195.5L0 0v200h1280V0"></path> </svg>

    </div>

    <div id="screenItem_who" class="screenItem screenItem_who">
        <div class="container-new">
            <div class="wrap-row ai_center">

                <div class="title_image hiddenBlock">
                    <div class="title_image__text">
                        Как мы работаем
                    </div>
                </div>

                <div class="text_section hiddenText">
                    Мы готовы предложить Вам как платные прогнозы, которые содержат всестороннюю, максимально взвешенную и грамотную аналитику предстоящих спортивных игр от ведущих специалистов нашей команды, так и ознакомиться с не менее ценными бесплатными прогнозами, которые позволят вам понять <br>
                    и почувствовать качество нашей работы. <br>
                    Мир спорта зачастую непредсказуем, но и он поддается аналитике, <br>
                    благодаря которой вы можете минимизировать ваши риски.
                </div>

                <div class="succesBlock">
                    <div class="succesTitle">
                        <span>3 шага</span> к успеху
                    </div>

                    <div class="succesImageWrap">
                        <div class="succesImageItem">
                            <img src="img/succes1.png" alt="">
                        </div>
                        <div class="succesImageItem">
                            <img src="img/succes2.png" alt="">
                        </div>
                        <div class="succesImageItem">
                            <img src="img/succes3.png" alt="">
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>

    <div id="screenItem_start" class="screenItem parallax-window screenItem_start" data-ios-disabled="false" data-android-disabled="false" data-parallax="scroll" data-image-src="img/bg_4.jpg">

        <svg class="svg__top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 200" preserveAspectRatio="none"> <path d="M640 195.5L0 0v200h1280V0"></path> </svg>

        <a id="go_index"></a>
        <div class="container-new">
            <div class="wrap-row ai_center">
                <div class="title_image hiddenBlock">
                    <div class="title_image__text">
                        Начни свой путь к успеху!
                    </div>
                </div>
                <div class="text_section hiddenText">
                    Итак, если вы лишь в начале своего пути к процветанию, то у вас есть возможность воспользоваться нашими бесплатными прогнозами, которые дадут вам возможность <br>
                    почувствовать качество нашей работы. <br>
                    <br>
                    Для серьезных игроков, стремящихся к успеху, мы предлагаем платные прогнозы с большей проходимостью <br>
                    и большими возможностями.
                </div>

                <div id="cardsWrap" class="cardsWrap">

                    <div class="cardItem cardItem_1">
                        <div class="cardItem__image">
                            <img src="img/gift.png" alt="">
                        </div>
                        <div class="cardItem__title">
                            БЕСПЛАТНЫЕ ПРОГНОЗЫ
                        </div>
                        <div class="cardItem__list">
                            <ul>
                                <li>ВЕРОЯТНОСТЬ ВЫИГРЫША ~ 75%</li>
                                <li>ДО 7 ПРОГНОЗОВ КАЖДЫЙ ДЕНЬ</li>
                                <li>ЦЕНА: <span class="color_red">БЕСПЛАТНО</span></li>
                            </ul>
                        </div>
                        <div class="cardItem__btn">
                            <a class="btn_usually" href="<?=\yii\helpers\Url::to(['site/free-forecast-list'])?>">Подробнее</a>
                        </div>
                    </div>

                    <div class="cardItem cardItem_2">
                        <div class="cardItem__image">
                            <img src="img/champions.png" alt="">
                        </div>
                        <div class="cardItem__title">
                            <span>VIP</span> ПРОГНОЗЫ
                        </div>
                        <div class="cardItem__list">
                            <ul>
                                <li>ВЕРОЯТНОСТЬ ВЫИГРЫША ~ 85%</li>
                                <li>ДО 3 ПРОГНОЗОВ КАЖДЫЙ ДЕНЬ</li>
                                <li>ЦЕНА: 2990 - 6990 ₽</li>
                            </ul>
                        </div>
                        <div class="cardItem__btn">
                            <a class="btn_usually btn_usually_yellow" href="<?=\yii\helpers\Url::to(['site/vip-forecast-list'])?>">Подробнее</a>
                        </div>
                    </div>

                    <div class="cardItem cardItem_3">
                        <div class="cardItem__title">
                            РАСКРУТКА <br> ВАШЕГО <br> СЧЕТА
                        </div>
                        <div class="cardItem__image">
                            <img src="img/diagram.png" alt="">
                        </div>
                        <div class="cardItem__btn">
                            <a class="btn_usually" href="<?=\yii\helpers\Url::to(['site/promotion'])?>">Подробнее</a>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <div class="screenItem screenItem_gif">
        <div class="container-new">
            <div class="wrap-row jc_center">
                <div class="gif_icon">
                    <img src="img/gif_icon1.gif" alt="">
                </div>
                <div class="gif_icon">
                    <img src="img/gif_icon2.gif" alt="">
                </div>
                <div class="gif_title">
                    <img src="img/gif1.gif" alt="">
                </div>
                <div class="gif_icon">
                    <img src="img/gif_icon3.gif" alt="">
                </div>
                <div class="gif_icon">
                    <img src="img/gif_icon4.gif" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="screenItem screenItem_contact">
        <div class="container-new">



            <div class= jc_center">
                <div class="index-banner-block"><?foreach ($banners as $b) : ?><a href="<?=$b->href?>" target="_blank"><img src="<?=$b->getThumb()?>" /></a><?endforeach;?></div>







                <a class="anchor" id="callback"></a>
                <div class="contactBlock">
                    <div class="contactBlock__title">Остались вопросы?</div>
                    <div class="contactBlock__description">Оставьте свои данные, задайте любой вопрос и получите ответ на него</div>



                    <div class="contactForm">
                        <?php $form = ActiveForm::begin([
                            'id' => 'index-form',
                            'fieldConfig' => [
                                'template' => '{input}{label}<div class="help-block help-block-error">{hint}</div>',
                                'inputOptions' => [ 'class' => false],
                                'labelOptions' => [ 'class' => 'contactFotm__label'],
                                'options' => [
                                    'tag' => 'div',
                                    'class' => 'contactFotm__inputBlock'
                                ],
                            ],
                            'enableAjaxValidation' => false,
                            'options' => [
                                'class' => 'index-form'
                            ]
                        ]); ?>



                        <div class="contactForm">
                            <?= $form->field($model, 'name')->textInput() ?>

                            <?= $form->field($model, 'phone')->textInput() ?>

                            <?= $form->field($model, 'email')->textInput() ?>
                            <div class="contactForm__inputBtn">
                                <button>Отправить</button>
                            </div>
                            <div class="contactForm__policy">
                                Нажимая на кнопку, вы соглашаетесь с <a href="">политикой обработки данных</a>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>


        <a class="anchor" id="contacts"></a>
        <div class="screenItem screenItem_contacts">
            <div class="container-new">
                <p>Свяжитесь со мной по телефону или почте</p>
                <div class="phone_text">+7 977 677 3330</div>
                <div class="email_text">info@eebet.ru</div>
                <div class="name_text">
                    Егор Ермолаев
                </div>
                <div class="sociallinks">
                    <div class="sociallinks__item">
                        <a href="https://vk.com/eebet" target="_blank">
                            <svg class="sociallinks__svg" version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve">
                                    <desc>VK</desc>
                                <path style="fill:#002c5e;" d="M41.2 22.2c.6-.8 1.1-1.5 1.5-2 2.7-3.5 3.8-5.8 3.5-6.8l-.2-.2c-.1-.1-.3-.3-.7-.4-.4-.1-.9-.1-1.5-.1h-7.2c-.2 0-.3 0-.3.1 0 0-.1 0-.1.1v.1c-.1 0-.2.1-.3.2-.1.1-.2.2-.2.4-.7 1.9-1.5 3.6-2.5 5.2-.6 1-1.1 1.8-1.6 2.5s-.9 1.2-1.2 1.5c-.3.3-.6.6-.9.8-.2.3-.4.4-.5.4-.1 0-.3-.1-.4-.1-.2-.1-.4-.3-.5-.6-.1-.2-.2-.5-.3-.9 0-.4-.1-.7-.1-.9v-1.1-1-1.9c0-.7 0-1.2.1-1.6v-1.3c0-.4 0-.8-.1-1.1-.1-.3-.1-.5-.2-.7-.1-.2-.3-.4-.5-.6-.2-.1-.5-.2-.8-.3-.8-.2-1.9-.3-3.1-.3-2.9 0-4.7.2-5.5.6-.3.2-.6.4-.9.7-.3.3-.3.5-.1.6.9.1 1.6.5 2 1l.1.3c.1.2.2.6.3 1.1.1.5.2 1.1.2 1.7.1 1.1.1 2.1 0 2.9-.1.8-.1 1.4-.2 1.9-.1.4-.2.8-.3 1.1-.1.3-.2.4-.3.5 0 .1-.1.1-.1.1-.1-.1-.4-.1-.6-.1-.2 0-.5-.1-.8-.3-.3-.2-.6-.5-1-.9-.3-.4-.7-.9-1.1-1.6-.4-.7-.8-1.5-1.3-2.4l-.4-.7c-.2-.4-.5-1.1-.9-1.9-.4-.8-.8-1.6-1.1-2.4-.1-.3-.3-.6-.6-.7l-.1-.1c-.1-.1-.2-.1-.4-.2s-.3-.1-.5-.2H3.2c-.6 0-1.1.1-1.3.4l-.1.1c0 .1-.1.2-.1.4s0 .4.1.6c.9 2.2 1.9 4.3 3 6.3s2 3.6 2.8 4.9c.8 1.2 1.6 2.4 2.4 3.5.8 1.1 1.4 1.8 1.7 2.1.3.3.5.5.6.7l.6.6c.4.4.9.8 1.6 1.3.7.5 1.5 1 2.4 1.5.9.5 1.9.9 3 1.2 1.2.3 2.3.4 3.4.4H26c.5 0 .9-.2 1.2-.5l.1-.1c.1-.1.1-.2.2-.4s.1-.4.1-.6c0-.7 0-1.3.1-1.8s.2-.9.4-1.2c.1-.3.3-.5.5-.7.2-.2.3-.3.4-.3.1 0 .1-.1.2-.1.4-.1.8 0 1.3.4s1 .8 1.4 1.3c.4.5 1 1.1 1.6 1.8.6.7 1.2 1.2 1.6 1.5l.5.3c.3.2.7.4 1.2.5.5.2.9.2 1.3.1l5.9-.1c.6 0 1-.1 1.4-.3.3-.2.5-.4.6-.6.1-.2.1-.5 0-.8-.1-.3-.1-.5-.2-.6-.1-.1-.1-.2-.2-.3-.8-1.4-2.2-3.1-4.4-5.1-1-.9-1.6-1.6-1.9-1.9-.5-.6-.6-1.2-.3-1.9.3-.5 1-1.5 2.2-3z">
                                </path>
                                </svg>
                        </a>
                    </div>
<!--                    <div class="sociallinks__item">-->
<!--                        <a href="https://www.instagram.com/eebets/" target="_blank">-->
<!--                            <svg class="sociallinks__svg" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">-->
<!--                                    <desc>Instagram</desc>-->
<!--                                <path style="fill:#002c5e;" d="M16.396,3.312H8.604c-2.921,0-5.292,2.371-5.292,5.273v7.846c0,2.886,2.371,5.256,5.292,5.256h7.791c2.922,0,5.292-2.37,5.292-5.274V8.586C21.688,5.683,19.317,3.312,16.396,3.312L16.396,3.312z M7.722,12.5c0-2.64,2.142-4.778,4.778-4.778c2.636,0,4.777,2.138,4.777,4.778s-2.142,4.777-4.777,4.777C9.864,17.277,7.722,15.14,7.722,12.5zM17.756,8.182c-0.615,0-1.104-0.487-1.104-1.102s0.488-1.103,1.104-1.103c0.614,0,1.102,0.488,1.102,1.103S18.37,8.182,17.756,8.182L17.756,8.182z">-->
<!--                                </path>-->
<!--                                <path style="fill:#002c5e;" d="M12.5,9.376c-1.731,0-3.124,1.398-3.124,3.124c0,1.725,1.393,3.124,3.124,3.124c1.732,0,3.124-1.399,3.124-3.124C15.624,10.775,14.211,9.376,12.5,9.376L12.5,9.376z"></path>-->
<!--                                </svg>-->
<!--                        </a>-->
<!--                    </div>-->
                    <div class="sociallinks__item">
                        <a href="https://t.me/eebet1" target="_blank">
                            <svg class="sociallinks__svg" version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 60 60" xml:space="preserve">
                                <desc>Telegram</desc>
                                <path style="fill:#002c5e;" d="M52.5,9L6.1,26.9c-0.9,0.4-0.9,1.8,0,2.3l11.9,4.9l4.4,14.1c0.3,0.8,1.2,1,1.8,0.5l6.8-6.4l12.9,8.7c0.7,0.4,1.6,0,1.7-0.7L54,10.3C54.2,9.5,53.3,8.7,52.5,9z M24.5,36.7L23.8,44l-3.6-11.2l25.3-16.8L24.5,36.7z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>