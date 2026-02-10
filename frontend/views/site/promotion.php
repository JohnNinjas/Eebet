<?php


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\Promotions */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Alert;

$fieldOptions1 = [
    'template' => '{label}{input}<p class="help-block help-block-error">{hint}</p>'
];

$fieldOptions2 = '<div class="contactForm__checkbox">{beginLabel}{input} <div class="checkboxIndicator"></div><div class="chechboxText">{labelTitle}</div>{endLabel}
<p class="help-block help-block-error">{hint}</p></div>';


$this->title = 'Раскрутка счёта';
$this->registerMetaTag(['name' => 'description', 'content' => 'Раскрутка счёта']);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:url',
    'content' => \yii\helpers\Url::canonical(),
]);
\Yii::$app->view->registerMetaTag([
    'property' => 'og:title',
    'content' => $this->title,
]);

\Yii::$app->view->registerMetaTag([
    'property' => 'og:description',
    'content' => 'Раскрутка счёта',
]);


?>

<div class="page">

    <div class="headeredPage headeredPage_3 headeredPage__acc">
        <div class="headeredPage__title">
            <img src="/img/headered1.png" alt="">
            <span>Раскрутка счета</span>
        </div>
    </div>

    <div class="pageContent promo_bg">

        <div class="bg_image">

            <div class="container-new">

                <div class="contentTitle">
                    ДОВЕРИТЕЛЬНОЕ УПРАВЛЕНИЕ СЧЕТОМ В БК / РАСКРУТКА СЧЕТА
                </div>

                <div class="countCards">
                    <p>Предлагаем два варианта раскрутки Вашего счета в БК:</p>
                    <div class="countCardsRow">
                        <div class="countCardItem">
                            <div class="countCardItem__summ">
                                * Счета на сумму 25-100 т.р
                            </div>
                            <div class="countCardItem__text">
                                принимают раскрутчики прошедшие сложный конкурс. <br>
                                Подходят счета в следующих букмекерских конторах: <br>
                                BetCity, 1Xставка, Marathonebet, Олимп, <br>
                                Фонбет, Лига Ставок, Пари-Матч, Winline <br>
                                (в любой из данных контор)
                            </div>
                        </div>
                        <div class="countCardItem">
                            <div class="countCardItem__summ">
                                * Счета на сумму от 100 т.р
                            </div>
                            <div class="countCardItem__text">
                                принимают «VIP раскрутчики», т.е. самые опытные, показывающие наилучшие результаты среди
                                всех раскрутчиков счетов. Подходят счета в букмекерских конторах: BetCity, 1Xставка,
                                Marathonebet, Олимп, Фонбет, Лига Ставок, Пари-Матч, Winline
                                (в любой из данных контор).
                            </div>
                        </div>
                    </div>

                    <div class="countCards__notice">
                        Обращаем Ваше внимание на то, что после передачи счёта на «Раскрутку», клиенту строго запрещено
                        самостоятельно совершать ставки на переданном счёте и заходить на счёт без предупреждения (так
                        как при одновременном заходе с раскрутчиком с разных ip и разных регионов, у букмекерских контор
                        могут возникнуть вопросы и это может привести к блокировке Вашего счета по причинам, не
                        зависящим от нас)
                    </div>

                </div>

                <div class="conditionBlock">
                    <div class="conditionBlock__title">
                        Наши условия предоставления услуг по раскрутке счета:
                    </div>
                    <div class="conditionList">
                        <ul>
                            <li>После прироста на счёте (прибыли на счёте), мы сообщаем Вам об этом (уведомляем по VK,
                                Telegram или смс на телефон). В течение суток после получения вышеуказанного уведомления
                                вам необходимо оплатить на наш счет 50% от чистой прибыли. Например: у Вас было на
                                балансе 30 т.р., в результате нашей работы по раскрутке стало - 60 т.р. (т.е. чистая
                                прибыль составляет 30 т.р.), следовательно, Вы оплачиваете наши услуги в размере 15
                                т.р., а мы продолжаем работу по раскрутке.
                            </li>
                            <li>На балансах от 25-100 т.р., расчёт ведётся за каждые 10-20 т.р. прибыли на счёте, без
                                гаранта максимума ставки.
                            </li>
                            <li>На балансах от 100 т.р., расчёт ведется за каждые 20-40 т.р. прибыли на счёте, максимум
                                ставки 10% от счета (обратите внимание, что максимум ставки действует только на балансах
                                от 100 т.р. Если клиент в заявке при передаче счета НЕ указал: «Соблюдение максимума по
                                ставке», то возможна работа без оговорки максимума на ставки на усмотрение назначенного
                                раскрутчика).
                            </li>
                            <li>В среднем прибыль на счете достигается за 2-5 дней (это зависит от множества объективных
                                причин).
                            </li>
                            <li>Раскруткой Вашего счета будут заниматься только квалифицированные и проверенные
                                специалисты (чем больше баланс счета, тем выше требования к каперу, т.е. чем выше сумма
                                на балансе вашего счета, тем меньше вероятность его проигрыша).
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>

        <div class="aboutSpecialist">
            <div class="container-new">
                <div class="aboutSpecialist__text">Чем больше Ваша прибыль, тем выше заработок наших специалистов,
                    поэтому мы максимально заинтересованы в раскрутке Вашего счета! Ежедневно проводится серьезная
                    аналитическая работа по анализу предстоящих соревнований (матчей, турниров, игр). Тем не менее
                    стопроцентных гарантий от проигрыша мы дать не можем, т.к. всегда остается риск форс-мажорных
                    обстоятельств, которые не поддаются аналитике.
                </div>
                <div class="aboutSpecialist__mainText">
                    Наши специалисты настроены зарабатывать и получать прибыль вместе с Вами!
                </div>
            </div>

        </div>

        <div class="bg_image bg_money">
            <div class="container-new">

                <div class="insuranceBlock">
                    <div class="insuranceBlock__image">
                        <img src="/img/sheet.png" alt="">
                    </div>
                    <div class="insuranceBlock__text">
                        <div class="insuranceBlock__mainText">
                            Обратите внимание, что Ваш счет в БК <span class="red_color">МАКСИМАЛЬНО ЗАСТРАХОВАН</span>
                            от несанкционированного вывода с него денежных средств, в т.ч. и нашими специалистами, т.к.
                            эта гарантия предусмотрена в обязательном порядке в правилах ВСЕХ букмекерских контор
                        </div>
                        <p>(деньги с игрового счета возможно вывести только на те реквизиты
                            (способы оплаты) с которых был пополнен счет, т.е. и даже если у Вас
                            кто-то украдет логин и пароль, деньги он вывести все-равно не сможет).</p>
                    </div>
                </div>

                <div class="contactForm promotion">
                    <div class="contactForm__title">
                        Если Вы согласны со всеми вышеуказанными условиями предоставления <br>
                        услуг по раскрутке счета, заполните следующую форму:
                    </div>


                    <?= Alert::widget() ?>
                    <?php $form = ActiveForm::begin([
                        'id' => 'promotion-form',
                        'fieldConfig' => [
                            'template' => '{label}{input}{hint}{error}',
                            'options' => [
                                'tag' => 'div',
                                'class' => 'contactForm__field'
                            ],
                        ],
                        'enableAjaxValidation' => false,
                        'options' => [
                            'class' => 'promotion-form'
                        ]
                    ]); ?>
                    <?= $form->field($model, 'bookie_name', $fieldOptions1)->textInput() ?>
                    <?= $form->field($model, 'bookie_link', $fieldOptions1)->textInput() ?>
                    <?= $form->field($model, 'login', $fieldOptions1)->textInput() ?>
                    <?= $form->field($model, 'password', $fieldOptions1)->textInput() ?>
                    <?= $form->field($model, 'balance', $fieldOptions1)->textInput() ?>
                    <?= $form->field($model, 'phone', $fieldOptions1)->textInput() ?>
                    <?= $form->field($model, 'full_name', $fieldOptions1)->textInput() ?>
                    <?= $form->field($model, 'social_link', $fieldOptions1)->textInput() ?>
                    <?= $form->field($model, 'comment', $fieldOptions1)->textInput() ?>
                    <?= $form->field($model, 'agree', ['labelOptions' => ['label' => $model->getAttributeLabel('agree')], 'template' => $fieldOptions2])->checkbox([], false) ?>
                    <div class="contactForm__btn">
                        <?= Html::submitButton('Отправить', ['name' => 'promotion-button']) ?>
                    </div>


                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>

    </div>

</div>
